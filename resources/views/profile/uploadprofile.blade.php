<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Profile Photo</title>

    @vite(['resources/css/app.css'])

    <!-- Include Cropper.js Styles and Script -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
    
</head>
@include('includes.nav')
  <!-- Main Content Area -->
 
<body class="bg-gray-100 flex items-center justify-center h-full min-h-screen px-2  ">
    <div class="mt-24 bg-white p-8 rounded-lg shadow-[0px_0px_0px_1px_rgba(0,0,0,0.06),0px_1px_1px_-0.5px_rgba(0,0,0,0.06),0px_3px_3px_-1.5px_rgba(0,0,0,0.06),_0px_6px_6px_-3px_rgba(0,0,0,0.06),0px_12px_12px_-6px_rgba(0,0,0,0.06),0px_24px_24px_-12px_rgba(0,0,0,0.06)] w-[90%] max-w-[500px] mx-auto sm:px-6">
        <h2 class="text-2xl font-bold text-center mb-4">Upload Profile Photo</h2>
    

  <!-- Success Message -->
@if(session('success'))
    <div id="success-message" class="flex w-full overflow-hidden bg-emerald-50 rounded-lg shadow-[0px_2px_3px_-1px_rgba(0,0,0,0.1),0px_1px_0px_0px_rgba(25,28,33,0.02),0px_0px_0px_1px_rgba(25,28,33,0.08)] dark:bg-gray-800 mb-4">
        <div class="flex items-center justify-center w-12 bg-emerald-500">
            <svg class="w-6 h-6 text-white fill-current" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
                <path d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM16.6667 28.3333L8.33337 20L10.6834 17.65L16.6667 23.6166L29.3167 10.9666L31.6667 13.3333L16.6667 28.3333Z" />
            </svg>
        </div>

        <div class="px-4 py-2 -mx-3">
            <div class="mx-3">
                <span class="font-semibold text-emerald-500 dark:text-emerald-400">Success</span>
                <p class="text-sm text-gray-600 dark:text-gray-200">{{ session('success') }}</p>
            </div>
        </div>
    </div>

    <script>
        // Hide the success message after 3 seconds
        setTimeout(function() {
            document.getElementById('success-message').style.display = 'none';
        }, 3000);
    </script>
@endif


        <!-- Image Preview and Upload Icon -->
<div class="flex justify-center mb-4 ">
    <div class="relative">
        <img id="profile-photo-preview" 
             src="{{ asset('storage/' . ($user->profile_picture ? $user->profile_picture : 'profile_photos/' . $user->default_profile)) }}"
             alt="Profile Photo"
             class="h-24 w-24 object-cover rounded-full border-2 border-gray-300 cursor-pointer" 
             onclick="triggerFileInput()">
        
        <label for="profile_photo" class="absolute bottom-0 right-[-10px]  text-white rounded-full p-2 cursor-pointer" >
            <img src="https://static.wixstatic.com/media/632b5a_5ba6f3f001ca4e61a7fd95228e1bffba~mv2.png" alt="Upload Image Icon" class="w-[30px] h-[30px] ">
        </label>
        <input type="file" id="profile_photo" name="profile_photo" style="display: none;" onchange="previewImage(event)">
    </div>
</div>


        <!-- Hidden Form for Cropped Image Data -->
        <form id="crop-form" method="POST" action="{{ route('profile.upload') }}" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <input type="hidden" name="cropped_profile_photo" id="cropped_profile_photo">
        </form>

        
    </div>

    <!-- Modal for Cropping Image -->
    <div id="crop-modal" class="fixed inset-0 flex justify-center items-center bg-black bg-opacity-50 hidden">
        <div class="bg-white p-6 rounded-lg w-[90%] max-w-[500px]">
            <h3 class="text-xl font-bold mb-4">Crop Your Profile Photo</h3>
            <div class="flex justify-center mb-4">
                <img id="image-to-crop" src="" alt="Image to Crop" class="max-w-full rounded-lg">
            </div>
            <div class="flex justify-center space-x-4">
                <button id="crop-btn" class="bg-green-500 text-white p-2 rounded-md">Crop</button>
                <button id="close-modal-btn" class="bg-red-500 text-white p-2 rounded-md">Cancel</button>
            </div>
        </div>
    </div>
    </main>
    <script>
        let cropper;
        const modal = document.getElementById('crop-modal');
        const imageInput = document.getElementById('profile_photo');
        const imagePreview = document.getElementById('profile-photo-preview');
        const imageToCrop = document.getElementById('image-to-crop');
        const cropBtn = document.getElementById('crop-btn');
        const closeModalBtn = document.getElementById('close-modal-btn');
        const cropForm = document.getElementById('crop-form');
        const croppedProfilePhotoInput = document.getElementById('cropped_profile_photo');

        // Trigger the file input when image or plus icon is clicked
        function triggerFileInput() {
            document.getElementById('profile_photo').click();
        }

        // Open modal and show selected image for cropping
        function previewImage(event) {
            const file = event.target.files[0];
            if (!file) return;

            const reader = new FileReader();
            reader.onload = function(e) {
                imageToCrop.src = e.target.result;
                modal.classList.remove('hidden');  // Show the modal after image load
                cropper = new Cropper(imageToCrop, {
                    aspectRatio: 1,
                    viewMode: 1,
                    autoCropArea: 1,
                });
            };
            reader.readAsDataURL(file);
        }

        // Crop and upload the image
        cropBtn.addEventListener('click', function() {
            const canvas = cropper.getCroppedCanvas();
            const croppedImage = canvas.toDataURL('image/jpeg');

            // Show the cropped image in the preview
            imagePreview.src = croppedImage;

            // Set the cropped image to the hidden input for submission
            croppedProfilePhotoInput.value = croppedImage;

            // Submit the form
            cropForm.submit();

            // Close the modal
            modal.classList.add('hidden');
        });

        // Close the modal without cropping
        closeModalBtn.addEventListener('click', function() {
            modal.classList.add('hidden');
            if (cropper) {
                cropper.destroy();
            }
        });
    </script>

</body>
</html>
