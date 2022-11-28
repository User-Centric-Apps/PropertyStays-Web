<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist;
use Auth;

class WishlistController extends Controller
{
    public function __construct() 
    {
        $this->middleware('auth');
    }
    
    public function propertyWishlist(Request $request)
    {
        $user = Auth::user();
        $wishlists = array();
        $wishlists = Wishlist::select('wishlists.id', 'properties.title', 'properties.image', 'properties.original_price', 'wishlists.property_id', 'wishlists.created_at')
            ->leftjoin('properties', 'properties.id', '=', 'wishlists.property_id')
            ->where('wishlists.user_id', '=', $user->id)
            ->where('wishlists.type', '=', 1)
            ->orderby('wishlists.id', 'desc')
            ->paginate(9);
        return view('users.propertywishlist', compact('wishlists'));
    }
    
    public function tourWishlist(Request $request)
    {
        $user = Auth::user();
        $wishlists = array();
        $wishlists = Wishlist::select('wishlists.id', 'tours.title', 'tours.image', 'tours.adult_price', 'wishlists.property_id', 'wishlists.created_at')
            ->leftjoin('tours', 'tours.id', '=', 'wishlists.property_id')
            ->where('wishlists.user_id', '=', $user->id)
            ->where('wishlists.type', '=', 1)
            ->orderby('wishlists.id', 'desc')
            ->paginate(9);
        return view('user.tourwishlist', compact('wishlists'));
    }

    
    public function addWishlist($property_id, $type)
    {
        $status = Wishlist::where('user_id', Auth::user()->id)
        ->where('property_id', $property_id)
        ->where('type', $type)
        ->first();

        if(isset($status->user_id) and isset($property_id))
        {
           return redirect()->back()->with('danger', 'This item is already in your 
           wishlist!');
        }
        else
        {
           $wishlist = new Wishlist;

           $wishlist->user_id = Auth::user()->id;
           $wishlist->property_id = $property_id;
           $wishlist->type = $type;
           $wishlist->save();

           return redirect()->back()->with('success',
                         'Item Added to your wishlist.');
        }
    }

    public function destroyProperty($id)
    {
        $wishlist = Wishlist::findOrFail($id);
        $wishlist->delete();

        return redirect()->back()->with('success','Item successfully deleted');
    }
}
