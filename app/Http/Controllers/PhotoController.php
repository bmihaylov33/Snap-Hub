<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Photo;
use App\Models\User;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    public function index()
    {
        $photos = Photo::orderBy('created_at', 'desc')->paginate(10);
        return view('photos', compact('photos'));
    }

    public function home()
    {
        $lastTenPhotos = Photo::latest()->take(10)->get();
        return view('home', ['photos' => $lastTenPhotos]);
    }

    public function adminHome()
    {
        $lastFiveUsers = User::latest()->take(5)->get();

        $lastFivePhotos = Photo::with('user')->latest()->take(5)->get();

        return view('home', [
            'users' => $lastFiveUsers,
            'photos' => $lastFivePhotos,
        ]);
    }

    public function getPhoto(Photo $photo)
    {
        return view('photo.index', compact('photo'));
    }

    public function showUploadForm()
    {
        return view('photo.upload');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        if (auth()->user()->photos->count() >= 10) {
            return redirect()->back()->with('error', 'You have reached the maximum limit of 10 photos.');
        }

        $request->file('image')->move(public_path('images'), $request->file('image')->getClientOriginalName());

        Photo::create([
            'title' => $request->title,
            'user_id' => auth()->id(),
            'image_path' => '/images/' . $request->file('image')->getClientOriginalName(),
        ]);

        return redirect()->route('photos')->with('success', 'The photo was uploaded successfully!');
    }

    public function destroy(Photo $photo)
    {
        $photo->delete();
        return redirect()->route('photos')->with('success', 'The photo was deleted successfully!');
    }
}
