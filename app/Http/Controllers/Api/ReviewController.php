<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /** Check if the user has already reviewed the product */
    public function checkIfUserAlreadyReviewedTheProduct( $productId, $userId )
    {
        $review = Review::where( [
            'user_id' => $userId,
            'product_id' => $productId,
        ] )->first();

        return $review;
    }

    /** Store new review */
    public function store( Request $request )
    {
        $review = $this->checkIfUserAlreadyReviewedTheProduct( $request->product_id, $request->user()->id );

        if ( $review ) {
            return response()->json( [
                'error' => 'You have already reviewed this product'
            ] );
        } else {
            Review::create( [
                'user_id' => $request->user()->id,
                'product_id' => $request->product_id,
                'title' => $request->title,
                'body' => $request->body,
                'rating' => $request->rating
            ] );

            return response()->json( [
                'message' => 'Your review has been added and will be available soon'
            ] );
        }
    }

    /** Update review */
    public function update( Request $request )
    {
        $review = $this->checkIfUserAlreadyReviewedTheProduct( $request->product_id, $request->user()->id );

        if ( $review ) {
            $review->update( [
                'user_id' => $request->user()->id,
                'product_id' => $request->product_id,
                'title' => $request->title,
                'body' => $request->body,
                'rating' => $request->rating,
                'approved' => 0
            ] );

            return response()->json( [
                'message' => 'Your review has been update and will be available soon'
            ] );
        } else {
            return response()->json( [
                'error' => 'Something went wrong try again later'
            ] );
        }
    }

    /** Delete review */
    public function destroy( Request $request )
    {
        $review = $this->checkIfUserAlreadyReviewedTheProduct( $request->product_id, $request->user()->id );

        if ( $review ) {
            $review->delete();

            return response()->json( [
                'message' => 'Your review has been deleted successfully'
            ] );
        } else {
            return response()->json( [
                'error' => 'Something went wrong try again later'
            ] );
        }
    }
}
