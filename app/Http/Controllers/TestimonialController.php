<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use App\Models\Science;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use MongoDB\Driver\Session;
use Illuminate\Support\Facades\Auth;


class TestimonialController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = User::whereId($request->id)->firstOrFail();
        return view('testimonials.index', compact('user'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user = User::whereId($request->id)->firstOrFail();
        return view('testimonials.create', compact('user'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::whereId($request->id)->firstOrFail();

        $testimonial = new Testimonial([
            'user_id'     => $request->id,
            'testimonial' => $request->testimonial,
            'rating'      => $request->rating,
            'reviewer_id' => Auth::user()->id,
        ]);
        $testimonial -> save();

        return view('testimonials.index',compact('user'));
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function show(Testimonial $testimonial)
    {
        return view('testimonials.single',compact('testimonial'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function edit(Testimonial $testimonial)
    {
        return view('testimonials.edit',compact('testimonial'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Testimonial $testimonial)
    {
        //
    }


    public function destroy(Testimonial $testimonial)
    {
        //
    }


    public function signaler(Request $request)
    {
        return view('layouts.signaler');
    }


    public function review(Request $request)
    {
        $user = User::whereId($request->id)->firstOrFail();
        return view('profiles.reviews',compact('user'));
    }
}