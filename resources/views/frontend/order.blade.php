@extends('layouts.frontendmaster')
@section('content')
    <section id="orderForm">
        <div class="container">
            <div class="row">
                <div class="col-md-8 mx-auto text-center header_texts pt-10" style="margin-top: 20px ">
                    <h2>Order <span style="color: #00aeef;">Now</span></h2>
                    <h3 class="pt-3"><span style="color: #00aeef;">{{ $service_item->package_name }}</span></h3>
                    <h3 class="pt-3"><span style="color: #00aeef;">$ {{ $service_item->package_price }}</span></h3>
                </div>
            </div>
            <div class="row text-center pt-5" style="margin-bottom: 40px ">
                <div class="col-md-6 mx-auto ">
                    <form action="{{ route('order.submit', $service_item->id) }}" method="post" enctype="multipart/form-data"
                        class="text-center">
                        @csrf
                        <div class="form-group text-center">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                id="name" placeholder="Enter name">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">

                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                id="email" placeholder="Enter email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">

                            <input type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone"
                                id="phone" placeholder="Enter phone number">
                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">

                            <input type="text" class="form-control @error('file_link') is-invalid @enderror" name="file_link"
                                id="file_link" placeholder="Enter Your File Link">
                            @error('file_link')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="file" class="form-control @error('file') is-invalid @enderror" name="file"
                                id="file" placeholder="Choose Your File">
                            @error('file')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                        <button type="submit" class="btn btn-primary trail_btn">Confirm</button>


                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
