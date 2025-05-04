<footer class="footer">
    <div class="container">
        <div class="row">

            <div class="col-md-3">
                @if(!empty($footer->logo))
                    <img src="{{asset('storage/logo/'.$footer->logo)}}">
                @else
                    <img src="{{asset('frontend/assets/images/lala.png')}}">
                @endif
            </div>
            <div class="col-md-6">
                <h3 style="color: #FFFFFF">সাম্প্রতিক বিজ্ঞপ্তি</h3>
                <div class="holder">
                    <ul id="ticker01">
                        @foreach($notices as $notice)
                            <li><a href="{{url('notice/'.$notice->id)}}"><i
                                        class="fa fa-circle-o-notch"></i> {{$notice->title_bn}}</a></li>
                        @endforeach

                    </ul>
                </div>

            </div>
            <div class="col-md-3">
                <p>ভিডিও কনফারেন্সে সংযুক্ত হওয়ার জন্য এখানে ক্লিক করুন <br><a target="__blank" href="https://connect.army.mil.bd/slc"
                                                                class="btn btn-warning">জয়েন</a></p>

            </div>
        </div>
    </div>

    <div class="copyright text-center">
        © 2020 Information Technology Directorate, Army Headquarter | All Rights Reserved.
    </div>
</footer>
