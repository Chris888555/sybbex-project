<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Sales Funnel</title>
    @vite(['resources/css/app.css'])
    <style>
    body {
        background: url('https://dw8.site/client-test/uploads%2FUntitled%20design%20%282%29.jpg') no-repeat center center fixed;
        background-size: 100% 100%;
        min-height: 100vh;
        width: 100%;
    }
    </style>
</head>

<body class="pt-0">
    <!-- Main Content -->
    <div class="max-w-3xl w-full p-6 text-center mx-auto mt-2">
        <h1 class="text-[35px] leading-[40px] sm:leading-[50px] sm:text-5xl font-bold text-yellow-400 capitalize font-[Roboto]">Sybbex
            Na Ang Bahalang Mag Palago Ng Pera Mo!</h1>
        <p class="text-2xl sm:text-3xl text-gray-200 mt-2 capitalize">Most Trusted Investment Trading Company Worldwide With Guaranteed Daily Income
        </p>

<p class="text-base sm:text-lg text-[#38e6d6] mt-2 italic font-[Lato]"> 
    No Inviting, No Selling, Daily Passive Income, Daily Payout 
</p>


        
        <div class="mt-6">
            <div
                class="bg-blue-600 text-white text-center p-4 shadow-lg border-t border-x border-blue-700 rounded-t-2xl">
                <h2 class="text-2xl font-bold mb-2 flex items-center justify-center gap-2">
                    <svg class="h-6 w-6 text-yellow-400" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10" />
                        <line x1="12" y1="8" x2="12" y2="12" />
                        <line x1="12" y1="16" x2="12.01" y2="16" />
                    </svg>
                    Don't Miss This!
                </h2>
                <p class="text-[13px] sm:text-lg">Watch The Video Now To Discover All The Details!</p>
            </div>
        </div>


        <div class="relative w-full">
    <!-- Video with Thumbnail -->
    <video id="custom-video" controls
        class="w-full border-x-8 border-b-8 border-gray-200 shadow-[0_15px_40px_rgba(8,_112,_184,_0.3)] rounded-b-2xl"
        poster="https://d1yei2z3i6k35z.cloudfront.net/1841686/67e5596459432_mosttrusted10.jpg">
        <source src="https://d1yei2z3i6k35z.cloudfront.net/1841686/67e52a5463b4f_v3_SYBBEXVIDEOAD.mp4" type="video/mp4">
        Your Browser Does Not Support The Video Tag.
    </video>

    <!-- Play Button (Centered) -->
    <div id="play-button" class="absolute inset-0 flex items-center justify-center cursor-pointer">
        <img src="https://d1yei2z3i6k35z.cloudfront.net/1841686/67e55a7e66930_Sybbex.png" 
            alt="Play Button" 
            class="w-10 h-10 md:w-16 md:h-16 opacity-90 transition transform hover:scale-110">
    </div>
</div>

<script>
    const video = document.getElementById('custom-video');
    const playButton = document.getElementById('play-button');

    playButton.addEventListener('click', () => {
        video.play();
        playButton.style.display = 'none'; // Hide play button after playing
    });

    video.addEventListener('play', () => {
        playButton.style.display = 'none'; // Hide play button when playing
    });

    video.addEventListener('pause', () => {
        playButton.style.display = 'flex'; // Show play button when paused
    });
</script>


<!--<p class="text-sm text-gray-700 bg-orange-200 border-2 border-white p-3 sm:p-6 mt-6 rounded-lg">-->
<!--    Ready to start and earn passive income? Message mo ako sa Messenger para ma-guide kita paano mag-create account at mag-deposit.-->
<!--</p>-->

<p class="text-sm text-gray-300 rounded-lg mt-6">
    Ready to start and earn passive income? Message mo ako sa Messenger para ma-guide kita paano mag-create account at mag-deposit.
</p>




   <a href="{{ $user->facebook_link }}" class="mt-4 inline-block bg-yellow-500 text-gray-800 font-bold py-4 px-10 rounded-lg shadow-lg hover:bg-yellow-400 transition capitalize  
    text-lg px-6 py-3 md:text-2xl md:px-8 md:py-4 lg:text-3xl lg:px-10 lg:py-4 w-[80%] sm:w-[60%] text-center">
    

    Start Earning Now  
    <span class="block text-sm font-normal text-gray-700">Message me now here</span>
</a>





     
    </div>


    <div class="w-full pl-10 pr-10 max-w-[700px] space-y-6 m-auto mb-10 mt-10">
        <h2 class="text-[25px] font-bold text-white text-center">Bakit Sybbex Isa Sa Most Trusted Investment Trading
            Company Worldwide</h2>
        <div class="bg-white pl-10 pr-10 pt-5 pb-5 rounded-lg shadow-md flex items-center relative">
            <div
                class="absolute -left-5 top-1/2 transform -translate-y-1/2 bg-yellow-600 text-white text-2xl font-bold px-4 py-2 rounded-lg">
                1</div>
            <div>
                <h2 class="text-lg font-bold">We have offices in </h2>
                <p class="text-sm text-gray-600">Ireland, China, Korea, Vietnam and India. Dito makaka sigurado tayong
                    Legit ang platform na papasukin natin.</p>
            </div>
        </div>
        <div class="bg-white pl-10 pr-10 pt-5 pb-5 rounded-lg shadow-md flex items-center relative">
            <div
                class="absolute -right-5 top-1/2 transform -translate-y-1/2 bg-purple-600 text-white text-2xl font-bold px-4 py-2 rounded-lg">
                2</div>
            <div>
                <h2 class="text-lg font-bold">We have expert traders</h2>
                <p class="text-sm text-gray-600">na magti-trade para sayo, kaya hindi mo na kailangang mahirapan sa
                    pag-analyze ng charts at data. Dito, garantisado ang resulta mo sa tulong ng mga expert traders.
                </p>
            </div>
        </div>
        <div class="bg-white pl-10 pr-10 pt-5 pb-5 rounded-lg shadow-md flex items-center relative">
            <div
                class="absolute -left-5 top-1/2 transform -translate-y-1/2 bg-green-600 text-white text-2xl font-bold px-4 py-2 rounded-lg">
                3</div>
            <div>
                <h2 class="text-lg font-bold">We have legal documents</h2>
                <p class="text-sm text-gray-600">company operates under strict supervision by state security authorities
                    and financial regulators in Ireland. It is also subject to financial monitoring, auditing, and tax
                    compliance as confirmed by its registration with the Irish Official Register.</p>
            </div>
        </div>

       
    </div>



@if($user->group_toggle == 1)
    <div class="w-full flex justify-center sm:w-[700px] m-auto">
        <a href="{{ $user->join_fb_group }}" class="mt-4 inline-block bg-yellow-500 text-gray-800 font-bold py-4 px-10 rounded-lg shadow-lg hover:bg-yellow-400 transition capitalize  
            text-lg px-6 py-3 md:text-2xl md:px-8 md:py-4 lg:text-3xl lg:px-10 lg:py-4 w-[80%] sm:w-[60%] text-center">
            Join Messenger Group
            <span class="block text-sm font-normal text-gray-700">Click To Join Group Chat</span>
        </a>
    </div>
@endif

@if($user->page_toggle == 1)
    <div class="w-full flex justify-center sm:w-[700px] m-auto">
        <a href="{{ $user->page_link }}" class="mt-4 inline-block bg-yellow-500 text-gray-800 font-bold py-4 px-10 rounded-lg shadow-lg hover:bg-yellow-400 transition capitalize  
            text-lg px-6 py-3 md:text-2xl md:px-8 md:py-4 lg:text-3xl lg:px-10 lg:py-4 w-[80%] sm:w-[60%] text-center">
            Creat Your Free Account
            <span class="block text-sm font-normal text-gray-700">Click Here Now</span>
        </a>
    </div>
@endif



    <div class="w-full p-5 max-w-[700px] space-y-6 m-auto mb-10 mt-10">
        <h2 class="text-[25px] font-bold text-white text-center">Totoong Tao Na Kumikita Talaga Dito Sa Sybbex Platform
        </h2>
        <div class="bg-blue-600 text-white text-center p-4 shadow-lg border-t border-x border-blue-700 rounded-t-2xl">
            <h2 class="text-2xl font-bold mb-2 flex items-center justify-center gap-2">
                <svg class="h-6 w-6 text-yellow-400" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10" />
                    <line x1="12" y1="8" x2="12" y2="12" />
                    <line x1="12" y1="16" x2="12.01" y2="16" />
                </svg>
                Don't Miss Out!
            </h2>
            <p class="text-[13px] sm:text-lg">Play The Video Below ðŸ¤©</p>
        </div>
        <div class="!mt-0 w-full max-w-3xl p-4 bg-white shadow-lg ">
            <div class="relative w-full overflow-hidden rounded-lg">
                <video class="w-full h-auto !mt-0" controls>
                    <source
                        src="https://d1yei2z3i6k35z.cloudfront.net/1841686/67e289ffcf484_486254588_28976070458674898_4481913142558032887_n.mp4"
                        type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>
        </div>

        <div class="!mt-0 w-full max-w-3xl p-4 bg-white shadow-lg rounded-b-lg">
            <div class="flex justify-center">
                <label for="modal-toggle"
                    class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition cursor-pointer">
                    View More Testimonials
                </label>
            </div>


            <input type="checkbox" id="modal-toggle" class="hidden peer" />

            <input type="checkbox" id="modal-toggle" class="hidden peer" />
            <div
                class="fixed inset-0 bg-black bg-opacity-80 flex items-center justify-center hidden peer-checked:flex cursor-pointer">
                <!-- Modal Content -->
                <div class="bg-white p-6 rounded-lg shadow-lg w-[90%] sm:w-96 max-h-[80vh] overflow-y-auto relative cursor-default"
                    onclick="event.stopPropagation()">
                    <h2 class="text-xl font-bold mb-4">Testimonials</h2>
                    <div class="grid grid-cols-1 gap-2">
                        <img src="https://dw8.site/client-test/uploads%2F485798177_1405630107272565_421451980418951017_n.jpg"
                            alt="Testimonial"
                            class="w-full rounded-md shadow-[0px_10px_1px_rgba(221,_221,_221,_1),_0_10px_20px_rgba(204,_204,_204,_1)]" />
                        <img src="https://dw8.site/client-test/uploads%2F486091659_1405630030605906_6044480617517577444_n.jpg"
                            alt="Testimonial"
                            class="w-full rounded-md shadow-[0px_10px_1px_rgba(221,_221,_221,_1),_0_10px_20px_rgba(204,_204,_204,_1)]" />
                            
                             <img src="https://dw8.site/client-test/uploads%2F485646826_1404902180678691_1623998076904383619_n.jpg"
                            alt="Testimonial"
                            class="w-full rounded-md shadow-[0px_10px_1px_rgba(221,_221,_221,_1),_0_10px_20px_rgba(204,_204,_204,_1)]" />
                            
                        <img src="https://d1yei2z3i6k35z.cloudfront.net/1841686/67e28a7504ebf_485826024_2370869399965183_5017515692412324299_n.jpg"
                            alt="Testimonial"
                            class="w-full rounded-md shadow-[0px_10px_1px_rgba(221,_221,_221,_1),_0_10px_20px_rgba(204,_204,_204,_1)]" />
                            
                             <img src="https://d1yei2z3i6k35z.cloudfront.net/1841686/67e28a8932437_484212200_1000779162023025_7047561296354870751_n.jpg"
                            alt="Testimonial"
                            class="w-full rounded-md shadow-[0px_10px_1px_rgba(221,_221,_221,_1),_0_10px_20px_rgba(204,_204,_204,_1)]" />
                            
                             <img src="https://d1yei2z3i6k35z.cloudfront.net/1841686/67e28b585c9d1_484880497_1160701032197597_7710928739916012058_n.jpg"
                            alt="Testimonial"
                            class="w-full rounded-md shadow-[0px_10px_1px_rgba(221,_221,_221,_1),_0_10px_20px_rgba(204,_204,_204,_1)]" />
                            
                             
                             
                                <img src="https://d1yei2z3i6k35z.cloudfront.net/1841686/67e28c3541417_486377533_1787712708678280_2864982637199141817_n.jpg"
                            alt="Testimonial"
                            class="w-full rounded-md shadow-[0px_10px_1px_rgba(221,_221,_221,_1),_0_10px_20px_rgba(204,_204,_204,_1)]" />
                            
                             <img src="https://d1yei2z3i6k35z.cloudfront.net/1841686/67e28c5937021_484381665_1168708131613364_2891019978058425677_n.jpg"
                            alt="Testimonial"
                            class="w-full rounded-md shadow-[0px_10px_1px_rgba(221,_221,_221,_1),_0_10px_20px_rgba(204,_204,_204,_1)]" />
                            
                            
                            
                            
                    </div>
                    <!-- Close Button -->
                    <label for="modal-toggle"
                        class="absolute top-2 right-2 px-2 py-1 bg-red-300 text-gray-700 rounded-lg hover:bg-gray-400 transition cursor-pointer">
                        âœ•
                    </label>
                    <label for="modal-toggle"
                        class="mt-4 px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition w-full text-center cursor-pointer block">
                        Close
                    </label>
                </div>
            </div>

            </label>
        </div>
    </div>

    <!-- Sybbex Company event videos-->

    <div class="bg-blue-600  text-white text-center p-4 shadow-lg border-blue-700 !mt-16">
        <h2 class="text-2xl font-bold mb-2 flex items-center justify-center gap-2">
            Here are the Sybbex Company event videos
        </h2>

    </div>

    <div class="!mt-0 w-full p-4 bg-white">

        <!-- Video List Section -->
        <section class="container mx-auto p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                <!-- Video 1 (Sybbex in South Korea) -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <h2 class="text-xl font-semibold text-center ">Sybbex in South Korea</h2>
                    <div class="relative pb-9/16">
                        <iframe class="absolute top-0 left-0 w-full h-full"
                            src="https://www.youtube.com/embed/teSGzHyVoak" frameborder="0" allow="encrypted-media"
                            allowfullscreen>
                        </iframe>
                    </div>
                    <!-- Watch Video Now Button with Icon -->
                    <div class="flex justify-center p-4">
                        <a href="https://www.youtube.com/live/teSGzHyVoak?si=mWrYqXo0DFceyApD" target="_blank"
                            class="bg-blue-600 text-white py-2 px-6 rounded-full text-xl font-semibold hover:bg-blue-700 transition duration-300 flex items-center space-x-2">
                            <i class="fas fa-video"></i> <!-- Watch Icon -->
                            <svg class="h-6 w-6 text-white inline-block ml-2" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10" />
                                <polygon points="10 8 16 12 10 16 10 8" />
                            </svg>
                            <span>Watch Video Now</span>
                        </a>
                    </div>
                </div>

                <!-- Video 2 (Sybbex Southeast Asia) -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <h2 class="text-xl font-semibold text-center ">Sybbex Southeast Asia</h2>
                    <div class="relative pb-9/16">
                        <iframe class="absolute top-0 left-0 w-full h-full"
                            src="https://www.youtube.com/embed/FZUZYsvV6sw" frameborder="0" allow="encrypted-media"
                            allowfullscreen>
                        </iframe>
                    </div>
                    <!-- Watch Video Now Button with Icon -->
                    <div class="flex justify-center p-4">
                        <a href="https://www.youtube.com/live/FZUZYsvV6sw?si=kq23lwKlgiibFV3t" target="_blank"
                            class="bg-blue-600 text-white py-2 px-6 rounded-full text-xl font-semibold hover:bg-blue-700 transition duration-300 flex items-center space-x-2">
                            <i class="fas fa-video"></i> <!-- Watch Icon -->

                            <svg class="h-6 w-6 text-white inline-block ml-2" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10" />
                                <polygon points="10 8 16 12 10 16 10 8" />
                            </svg>
                            <span>Watch Video Now</span>

                        </a>
                    </div>
                </div>

                <!-- Video 3 (Sybbex in Vietnam) -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <h2 class="text-xl font-semibold text-center ">Sybbex in Vietnam</h2>
                    <div class="relative pb-9/16">
                        <iframe class="absolute top-0 left-0 w-full h-full"
                            src="https://www.youtube.com/embed/MbwuDVqntlc" frameborder="0" allow="encrypted-media"
                            allowfullscreen>
                        </iframe>
                    </div>
                    <!-- Watch Video Now Button with Icon -->
                    <div class="flex justify-center p-4">
                        <a href="https://youtu.be/MbwuDVqntlc?si=JeXdsuGMHnbrACH2" target="_blank"
                            class="bg-blue-600 text-white py-2 px-6 rounded-full text-xl font-semibold hover:bg-blue-700 transition duration-300 flex items-center space-x-2">
                            <i class="fas fa-video"></i> <!-- Watch Icon -->
                            <svg class="h-6 w-6 text-white inline-block ml-2" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10" />
                                <polygon points="10 8 16 12 10 16 10 8" />
                            </svg>
                            <span>Watch Video Now</span>
                        </a>
                    </div>
                </div>

                <!-- Video 4 (CEO Tour from Headquarters) -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <h2 class="text-xl font-semibold text-center ">CEO Tour from Headquarters</h2>
                    <div class="relative pb-9/16">
                        <iframe class="absolute top-0 left-0 w-full h-full"
                            src="https://www.youtube.com/embed/TWXEVdMjJao" frameborder="0" allow="encrypted-media"
                            allowfullscreen>
                        </iframe>
                    </div>
                    <!-- Watch Video Now Button with Icon -->
                    <div class="flex justify-center p-4">
                        <a href="https://youtu.be/TWXEVdMjJao?si=q2lKDKIY7CCB5MD3" target="_blank"
                            class="bg-blue-600 text-white py-2 px-6 rounded-full text-xl font-semibold hover:bg-blue-700 transition duration-300 flex items-center space-x-2">
                            <i class="fas fa-video"></i> <!-- Watch Icon -->
                            <svg class="h-6 w-6 text-white inline-block ml-2" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10" />
                                <polygon points="10 8 16 12 10 16 10 8" />
                            </svg>
                            <span>Watch Video Now</span>
                        </a>
                    </div>
                </div>

            </div>
        </section>
    </div>
    <footer class="bg-gray-800 text-gray-400 py-10">
        <div class="container mx-auto text-center">
            <p class="text-sm">
                Â© 2025 <a href="https://www.businessforhome.com" class="hover:underline">Sybbex Team Ph</a>. All Rights
                Reserved.
            </p>
            <p class="text-xs mt-2 px-4">
                This site is not a part of the Facebook website or Facebook Inc. Additionally, this site is not endorsed
                by Facebook in any way.
                <span class="font-semibold">FACEBOOK</span> is a trademark of <span class="font-semibold">FACEBOOK,
                    Inc.</span>

                    <p class="text-sm text-gray-400 mt-4 px-6">
   At Sybbex, our team of 300 expert traders is committed to delivering guaranteed investment results. With cutting-edge strategies, risk management expertise, and a proven track record, we ensure your investments work smarter and grow faster. Partner with Sybbex for financial success you can trust.
</p>

            </p>
        </div>
    </footer>


   

</body>

</html>