<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    /** Display the list of users */
    public function index()
    {
        $users = User::latest()->get();

        return view( 'admin.users.index' )
            ->with( [
                'users' => $users
            ] );
    }

    /** Delete users */
    public function destroy( User $user )
    {
        if ( File::exists( public_path( $user->profile_image ) ) ) {
            File::delete( public_path( $user->profile_image ) );
        }

        $user->delete();

        return redirect()->route( 'admin.users.index' )
            ->with( [
                'success' => 'User deleted successfully'
            ] );
    }
}
