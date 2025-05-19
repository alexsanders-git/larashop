<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /** Display the list of reviews */
    public function index()
    {
        $reviews = Review::latest()->get();

        return view( 'admin.reviews.index' )
            ->with( [
                'reviews' => $reviews
            ] );
    }

    /** Approve or disapprove review */
    public function toggleApproveStatus( Review $review, $status )
    {
        $review->update( [
            'approved' => $status
        ] );

        return redirect()->route( 'admin.reviews.index' )
            ->with( [
                'success' => 'Review updated successfully!'
            ] );
    }

    /** Delete reviews */
    public function destroy( Review $review )
    {
        $review->delete();

        return redirect()->route( 'admin.reviews.index' )
            ->with( [
                'success' => 'Review deleted successfully'
            ] );
    }
}
