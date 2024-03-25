<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Http\Requests\Booking\BookingRequest;
use App\Repositories\BookingRepository;
use App\Repositories\ImageRepository;
use App\Http\Resources\BookingsResource;
use App\Models\User;
use App\Models\AdditionalInfo;
use App\Repositories\UserRepository;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Repositories\PaymentRepository;
use App\Models\Payment;
use Illuminate\Support\Facades\Log;

class BookingsController extends Controller
{

    protected $booking, $user, $payment, $image;

    public function __construct(BookingRepository $blogRepository, ImageRepository $imageRepository, UserRepository $userRepository, PaymentRepository $paymentRepository)
    {
        $this->booking = $blogRepository;
        $this->image = $imageRepository;
        $this->user = $userRepository;
        $this->payment = $paymentRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return BookingsResource::collection($this->booking->all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BookingRequest $request)
    {
        $status = true;

        $data = $request->validated();
        $bookingRecord = null;

        try {
            DB::beginTransaction();
            $booking_data = $request->collect((new Booking())->getFillable())
                ->toArray();
            $booking_data['booking_status'] = 0; // default pending

            $user = DB::table('users')
            ->where('email', '=', $request->email)
            ->first();
            $user_data = $request->collect((new User())->getFillable())
                ->toArray();
            $user_data['booking_counter'] = (! $user) ? ((int) $user->booking_counter + 1) : 1;
            

            if ($user == null) {
                $user_data['password'] = bcrypt(sha1(time()));
                $user = $this->user->create($user_data);
            }
            /* if (! $user) { */
            $booking_data['user_id'] = $user->id;
            $bookingRecord = $this->booking->create($booking_data);
            /*
             * } else {
             * return response(__("Error in User Information, contact Site Administrator!!"), 500);
             * }
             * if (! $bookingRecord) {
             */
            $additional_info_data = $request->collect((new AdditionalInfo())->getFillable())
                ->toArray();
            if (isset($data['visa_photo'])) {
                $image = $request->visa_photo;
                $imageName = time() . '.' . $image->extension();
                $imagePath = $this->image->uploadImage($image, $imageName);
                $additional_info_data['visa_photo'] = $imagePath;
            }
            
            $additional_info_data['bookings_id'] = $bookingRecord->id;
            $additionalRecord = AdditionalInfo::create($additional_info_data);
            
            $payment_data = $request->collect((new Payment())->getFillable())
                ->toArray();
            $payment_data['bookings_id'] = $bookingRecord->id;
            $payment_data['user_id'] = $user->id;
            //Log::info(print_r($payment_data,true));
            $paymentRecord = $this->payment->create($payment_data);
            $status = $status && $paymentRecord && $additionalRecord && $bookingRecord && $user;
            // }
            
        } catch (\Exception $e) {
            
            DB::rollBack();
            return response(__("Cannot create Booking, contact technical support!! " . $e), 500);
            // throw $e; //sometime you want to rollback AND throw the exception
        }
        // if previous DB action are OK
        if ($status) {
            DB::commit();
            $bookingRecord->user_id = $user->id;
            return response(new BookingsResource($bookingRecord), 201);
        } else {
            DB::rollBack();
            // return somme errors
            return response(__("Cannot create Booking, contact technical support!!"), 500);
        }
        /*
         * $booking = Booking::create($request->all());
         * return response()->json($booking, 201);
         */
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $booking = $this->booking->find($id);
        return $booking ?: response(__("Booking not found"), 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BookingRequest $request, $id)
    {
        $status = true;
        
        $data = $request->validated();
        $bookingRecord = null;
        
        try {
            DB::beginTransaction();
            $bookingRecord = $this->booking->find($id);
            $additional_info_id = $bookingRecord->ad;
            
            
            $booking_data = $request->collect((new Booking())->getFillable())
            ->toArray();
            $bookingRecord = $this->booking->update($id, $booking_data);

            $additional_info_data = $request->collect((new AdditionalInfo())->getFillable())
            ->toArray();
            if (isset($data['visa_photo'])) {
                $image = $request->visa_photo;
                $imageName = time() . '.' . $image->extension();
                $imagePath = $this->image->uploadImage($image, $imageName);
                $additional_info_data['visa_photo'] = $imagePath;
            }
            
            $additional_info_data['bookings_id'] = $bookingRecord->id;
            $additionalRecord = AdditionalInfo::update($id, $additional_info_data);
            
            $payment_data = $request->collect((new Payment())->getFillable())
            ->toArray();
            $payment_data['bookings_id'] = $bookingRecord->id;
            $payment_data['user_id'] = $user->id;
            //Log::info(print_r($payment_data,true));
            $paymentRecord = $this->payment->create($payment_data);
            $status = $status && $paymentRecord && $additionalRecord && $bookingRecord && $user;
            // }
            
        } catch (\Exception $e) {
            
            DB::rollBack();
            return response(__("Cannot create Booking, contact technical support!! " . $e), 500);
            // throw $e; //sometime you want to rollback AND throw the exception
        }
        // if previous DB action are OK
        if ($status) {
            DB::commit();
            $bookingRecord->user_id = $user->id;
            return response(new BookingsResource($bookingRecord), 201);
        } else {
            DB::rollBack();
            // return somme errors
            return response(__("Cannot create Booking, contact technical support!!"), 500);
        }
        
        $res = $this->booking->update($id, $data);
        return $res ? response($this->booking->find($id), 200) : response(__("Cannot update Booking, contact technical support!!"), 500);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if (! $id)
            return response(__("You Should Provide booking id"), 500);
        else
            $res = $this->booking->delete($id);
        return ($res == 1) ? response(__("Record Deleted Successfully"), 200) : response(__("Booking not found"), 404);
    }
}
