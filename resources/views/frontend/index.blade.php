@extends('layouts.frontendmaster')
@section('content')



<section class="pricing-plans" id="pricing-plans">
    <div class="container">
        <div class="row ">
            <div class="col-lg-6 m-auto text-center header_texts pt-10">
                <h3 style="color: #fff; font-size:38px; font-width:600;">Order Now</h3>
            </div>
        </div>
    </div>
@foreach ($plans as $plan)
<div class="pricing-card basic">
    <div class="heading">
        <h4 style=" color:#00aeef">{{ $plan->plan_name }}</h4>
        <p>{{ $plan->plan_description }}</p>
    </div>
    <p class="price">
        ${{ $plan->plan_price }}
        <sub>/month</sub>
    </p>
@foreach ($plan->planItems as $p_item)
<ul class="features">
    <li>
        <i class="fa-solid fa-check"></i>
        {{ $p_item->plan_item_name }}
    </li>

</ul>
@endforeach
    <a href="{{ route('plan_get', $plan->id) }}" class="cta-btn">SELECT</a>
</div>
@endforeach



</section>

<section id="single-plans">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 m-auto text-center header_texts">
                <h2>Single Plan</h2>
            </div>
        </div>
        

        @foreach ($services as $service)
        <div class="row v_l_middle mt_mar">
            <div class="col-lg-4 s_p_im">
                <div class="s_p_main d-flex">
                    <div class="s_p_image">
                        <img src="{{ asset($service->service_image) }}" alt="service_image" class="img-fluid w-100">
                    </div>
                    <div class="s_p_details">
                        <h3>{{ $service->service_name }} <span><i class="fa-brands fa-servicestack"></i></span></h3>
                        <p>{{ $service->service_description }}</p>
                    </div>
                </div>
            </div>
            @foreach ($service->ServicePackItems as $ss_item)
            <div class="col-lg-2 s_p_p text-center">
                <a href="{{ route('order', $ss_item->id) }}">
                    <div class="s_p_pricing_main">
                        <div class="s_p_content">
                            <h3>{{ $ss_item->package_name }}</h3>
                        </div>
                        <div class="s_p_price">
                            <p>@start from</p>
                            <h3>&#36 {{ $ss_item->package_price }} </h3>
                            <p>Per Image</p>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach

            <div class="col-lg-2 s_p_p text-center">
                <a href="#">
                    <div class="s_p_pricing_main">
                        <div class="s_p_content">
                            <h3>MUlti-Order</h3>
                        </div>
                        <div class="s_p_price">
                            <p>@start from</p>
                            <h3>Talk To Us </h3>
                            <p>Any Quantity</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        @endforeach


</section>

<section id="trailNowForm">
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto text-center header_texts">
                <h2>Trail <span style="color: #00aeef;">Now</span></h2>
            </div>
        </div>
        <div class="row text-center pt-5">
            <div class="col-md-6 mx-auto ">
                <form action="{{ route('freetrail.submit') }}" method="post" enctype="multipart/form-data" class="text-center">
                    @csrf
                    <div class="form-group text-center">

                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter name">
                    </div>
                    <div class="form-group">

                        <input type="email" class="form-control" name="email" id="email" placeholder="Enter email">
                    </div>
                    <div class="form-group">

                        <input type="tel" class="form-control" name="phone" id="phone" placeholder="Enter phone number">
                    </div>
                    <div class="form-group">

                        <input type="file" class="form-control" name="file" id="phone" placeholder="Choose Your File">
                    </div>

                    <button type="submit" class="btn btn-primary trail_btn">Submit</button>


                </form>
            </div>
        </div>
    </div>
</section>
@endsection