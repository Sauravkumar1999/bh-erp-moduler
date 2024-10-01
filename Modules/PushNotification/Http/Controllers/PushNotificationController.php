<?php

namespace Modules\PushNotification\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\PushNotification\DataTables\Editor\PushNotificationDataTableEditor;
use Modules\PushNotification\DataTables\TableView\PushNotificationDataTable;
use Modules\User\Entities\Role;
use Modules\User\Entities\User;
use Modules\PushNotification\Entities\PushNotification;
use Modules\PushNotification\Entities\DeviceToken; // Import the DeviceToken entity
use Illuminate\Database\QueryException;




class PushNotificationController extends Controller
{

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(PushNotificationDataTable $dataTable)
    {
        $breadcrumbs = [['name' => 'Home', 'url' => route('dashboard')], ['name' => 'Settings', 'url' => '#']];

        return user()->isAbleTo('view-push-notification') ?
            $dataTable->render('pushnotification::index', compact('breadcrumbs')) :
            redirect()->route('dashboard');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param PushNotificationDataTableEditor $editorTable
     * @return \Illuminate\Http\Response
     * @throws \Yajra\DataTables\DataTablesEditorException
     */
    public function store(Request $request, PushNotificationDataTableEditor $editorTable)
    {
        // dd($request->all());
        return $editorTable->process($request);
    }


    // get users function
    public function getUsers()
    {
        $users = User::select('id', 'code', 'first_name', 'last_name')->get();
        return response()->json($users);
    }

    // get roles function
    public function getRoles()
    {
        $roles = Role::select('id', 'name', 'display_name')->get();
        return response()->json($roles);
    }

    public function getUsersRoles(PushNotification $notification)
    {
        if ($notification->roles->isNotEmpty()) {
            return response()->json(['type' => 'roles', 'notifiables' => $notification->roles]);
        } else {
            return response()->json(['type' => 'users', 'notifiables' => $notification->users]);
        }
    }

    public function storeDeviceToken(Request $request, DeviceToken $deviceToken)
    {

        try {
            // Validate the incoming request data
            $validatedData = $request->validate([
                'user_id' => 'integer',
                'device_token' => 'required|string',
                'push_yn' => 'required|boolean',
            ]);

            // Check that at least one of user_id or email is present
            if (!isset($validatedData['user_id'])) {
                return response()->json(['success' => false, 'error' => 'user_id must be provided', 'code' => 400], 400);
            }

            $deviceToken->user_id = $validatedData['user_id'] ?? null;
            $deviceToken->device_token = $validatedData['device_token'];
            $deviceToken->push_yn = $validatedData['push_yn'];
            $deviceToken->save();

            // Return a JSON response with success flag, message, and status code
            return response()->json([
                'success' => true,
                'message' => 'Device token stored successfully',
                'code' => 201
            ], 201);
        } catch (QueryException $e) {
            // Check if the exception is due to a duplicate entry violation
            if ($e->errorInfo[1] === 1062) {
                return response()->json([
                    'success' => false,
                    'error' => 'Device token already exists',
                    'code' => 400
                ], 400);
            } else if ($e->errorInfo[1] === 1452) {
                // Handle other SQL errors without revealing specific details
                return response()->json([
                    'success' => false,
                    'error' => 'User doesnt exist, error occurred while storing the device token',
                    'code' => 500
                ], 500);
            } else {
                // Handle other SQL errors without revealing specific details
                return response()->json([
                    'success' => false,
                    'error' => 'An error occurred while storing the device token',
                    'message' => $e,
                    'code' => 500
                ], 500);
            }
        }
    }

    public function storePushNotice(Request $request, PushNotification $pushNotification)
    {

        try {
            // Validate the incoming request data
            $validatedData = $request->validate([
                'title' => 'string',
                'contents' => 'string',
                'email' => 'string',
                'user_id' => 'required|integer',
                'device' => 'required|string',
            ]);

            // Check that at least one of user_id or email is present
            if (!isset($validatedData['user_id']) && !isset($validatedData['email'])) {
                return response()->json(['success' => false, 'error' => 'User ID or Email must be provided', 'code' => 400], 400);
            }

            $pushNotification->title = $validatedData['title'] ?? null;
            $pushNotification->contents = $validatedData['contents'] ?? null;
            $pushNotification->email = $validatedData['email'] ?? null;
            $pushNotification->created_user_id = $validatedData['user_id'];
            $pushNotification->device = $validatedData['device'];
            $pushNotification->save();

            // Return a JSON response with success flag, message, and status code
            return response()->json([
                'success' => true,
                'message' => 'Push notice stored successfully',
                'code' => 201
            ], 201);
        } catch (QueryException $e) {
            // Check if the exception is due to a duplicate entry violation
            if ($e->errorInfo[1] === 1062) {
                return response()->json([
                    'success' => false,
                    'error' => 'Request Failed !!!',
                    'code' => 400
                ], 400);
            } else {
                // Handle other SQL errors without revealing specific details
                return response()->json([
                    'success' => false,
                    'error' => 'An error occurred while storing the push notice',
                    'message' => $e,
                    'code' => 500
                ], 500);
            }
        }
    }

    public function updatePushYN(Request $request, DeviceToken $deviceToken)
    {
        try {
            // Validate the incoming request data
            $validatedData = $request->validate([
                'device_token' => 'required|string',
                'push_yn' => 'required|boolean',
            ]);

            // Find the DeviceToken record based on the device_token
            $deviceToken = DeviceToken::where('device_token', $validatedData['device_token'])->first();

            if ($deviceToken) {
                // Update the push_yn field
                $deviceToken->push_yn = $validatedData['push_yn'];
                $deviceToken->save();

                return response()->json([
                    'success' => true,
                    'message' => 'Push notification status updated successfully',
                    'code' => 200
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'error' => 'Device token not found',
                    'code' => 404
                ], 404);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'An error occurred while updating push notification status',
                'message' => $e->getMessage(),
                'code' => 500
            ], 500);
        }
    }
}
