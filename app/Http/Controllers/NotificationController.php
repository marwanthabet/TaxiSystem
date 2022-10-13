<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class NotificationController extends Controller
{
    //
    public function markAsRead(Request $request, $id){
        $notification = auth()->user()->notifications()->where('id', '=', $id)->first();
        $notification->markAsRead();
        return redirect()->back();
    }

    public function destroy(Request $request, $id){
        $notification = auth()->user()->notifications()->where('id', '=', $id)->first();
        $deleted = $notification->delete();
        return response()->json([
            'message' => $deleted ? 'Deleted successfully' : 'Delete failed',
        ], $deleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }
}
