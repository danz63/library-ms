@extends('template/template')
@section('title','Data Peminjaman | Library Management System')
@section('content')
<div class="gradient h-10"></div>
<section class="bg-white pb-8">
    <div class="relative mt-12 lg:-mt-8 sm:mt-0 gradient">
        @include('svgs.wave')
    </div>
    <div>
        <div class="mt-8 opacity-75">
            @include('svgs.faq')
        </div>
        <div>
            <div class="mx-auto text-center px-4 mt-12 text-2xl text-indigo-900 font-semibold">Frequently Asked
                Questions</div>
            <dl class="mt-8 mx-auto max-w-screen-sm lg:max-w-screen-lg flex flex-col lg:flex-row lg:flex-wrap">
                <div class="lg:w-1/2">
                    <div
                        class="question-and-answer select-none cursor-pointer border-2 mx-8 my-3 px-6 py-4 rounded-lg text-sm group">
                        <dt class="question">
                            <div class="flex justify-between">
                                <div class="text-indigo-800 font-semibold">
                                    Do you accept Paypal?
                                </div>
                                <div>
                                    @include('svgs.accordionbtn')
                                </div>
                            </div>
                        </dt>
                        <dd class="answer hidden mt-2 leading-snug text-gray-700">
                            Yes, we do, along with AliPay, PayTM, and Payoneer.
                        </dd>
                    </div>
                </div>
                <div class="lg:w-1/2">
                    <div
                        class="question-and-answer select-none cursor-pointer border-2 mx-8 my-3 px-6 py-4 rounded-lg text-sm group">
                        <dt class="question">
                            <div class="flex justify-between">
                                <div class="text-indigo-800 font-semibold">
                                    What is your SLA Guarantee ?
                                </div>
                                <div>
                                    @include('svgs.accordionbtn')
                                </div>
                            </div>
                        </dt>
                        <dd class="answer hidden mt-2 leading-snug text-gray-700">
                            Yes, we do, along with AliPay, PayTM, and Payoneer.
                        </dd>
                    </div>
                </div>
                <div class="lg:w-1/2">
                    <div
                        class="question-and-answer select-none cursor-pointer border-2 mx-8 my-3 px-6 py-4 rounded-lg text-sm group">
                        <dt class="question">
                            <div class="flex justify-between">
                                <div class="text-indigo-800 font-semibold">
                                    Are there more Tailwind templates ?
                                </div>
                                <div>
                                    @include('svgs.accordionbtn')
                                </div>
                            </div>
                        </dt>
                        <dd class="answer hidden mt-2 leading-snug text-gray-700">
                            Yes, we do, along with AliPay, PayTM, and Payoneer.
                        </dd>
                    </div>
                </div>
                <div class="lg:w-1/2">
                    <div
                        class="question-and-answer select-none cursor-pointer border-2 mx-8 my-3 px-6 py-4 rounded-lg text-sm group">
                        <dt class="question">
                            <div class="flex justify-between">
                                <div class="text-indigo-800 font-semibold">
                                    Is this template free for commercial use ?
                                </div>
                                <div>
                                    @include('svgs.accordionbtn')
                                </div>
                            </div>
                        </dt>
                        <dd class="answer hidden mt-2 leading-snug text-gray-700">
                            Yes, we do, along with AliPay, PayTM, and Payoneer.
                        </dd>
                    </div>
                </div>
            </dl>
        </div>
    </div>
</section>

@endsection
@section('script')
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha256-pasqAKBDmFT4eHoN2ndd6lN370kFiGUFyTiUHWhU7k8=" crossorigin="anonymous"></script>
<script>
    $('.question-and-answer').click(function () {
            $(this).find(".answer").toggleClass("hidden")
            $(this).find(".question-chevron").toggleClass("hidden")
        })
</script>
@endsection