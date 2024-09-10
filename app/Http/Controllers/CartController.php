<?php
namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $user = Auth::user();
        $product_id = $request->input('product_id');
        $quantity = $request->input('quantity', 1);

        $cartItem = Cart::where('user_id', $user->id)
                        ->where('product_id', $product_id)
                        ->first();

        if ($cartItem) {
            $cartItem->quantity += $quantity;
            $cartItem->save();
        } else {
            Cart::create([
                'user_id' => $user->id,
                'product_id' => $product_id,
                'quantity' => $quantity,
            ]);
        }

        return response()->json(['message' => 'Product added to cart successfully.']);
    }

    public function getCartItems()
    {
        $user = Auth::user(); 
    
        $cartItems = Cart::where('user_id', $user->id)
                         ->with('product') 
                         ->get();
    
        return response()->json($cartItems);
    }

    public function deleteProduct($productId){
        $user = Auth::user();
        $cartItem = Cart::where('user_id', $user->id)
        ->where('product_id', $productId)
        ->first();
        $cartItem->delete();
        return response()->json(['message' => 'Product deleted from cart successfully.']);
    }

    public function updateQuantity(Request $request, $productId)
    {
        $user = Auth::user();
    
        $validatedData = $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);
    
        $cartItem = Cart::where('user_id', $user->id)
                        ->where('product_id', $productId)
                        ->first();
    
        if ($cartItem) {
            $cartItem->quantity = $validatedData['quantity'];
            $cartItem->save();
    
            return response()->json(['message' => 'Product quantity updated successfully.']);
        } else {
            return response()->json(['message' => 'Product not found in your cart.'], 404);
        }
    }

    public function checkout(Request $request){
        return view('checkout');
    }
}
