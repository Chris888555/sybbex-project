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
@include('includes.student-header')
  <!-- Main Content Area -->
 
<body class="bg-gray-100 flex items-center justify-center h-full min-h-screen px-2">
    <div class="bg-white p-8 rounded-lg shadow-[0px_0px_0px_1px_rgba(0,0,0,0.06),0px_1px_1px_-0.5px_rgba(0,0,0,0.06),0px_3px_3px_-1.5px_rgba(0,0,0,0.06),_0px_6px_6px_-3px_rgba(0,0,0,0.06),0px_12px_12px_-6px_rgba(0,0,0,0.06),0px_24px_24px_-12px_rgba(0,0,0,0.06)] w-[90%] max-w-[500px] mx-auto sm:px-6">
        <h2 class="text-2xl font-bold text-center mb-4">Upload Profile Photo</h2>
    

        @if(session('success'))
    <!-- Mobile View -->
    <div id="success-alert" class="alert flex md:hidden items-center p-4 mb-4 rounded-md text-sm bg-green-100 text-green-700 border border-green-400 
        w-[90%] left-1/2 transform -translate-x-1/2 relative m-0" role="alert">
        <svg class="w-5 h-5 mr-2" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M10.0043 13.3333V9.16663M9.99984 6.66663H10.0073M9.99984 18.3333C5.39746 18.3333 1.6665 14.6023 1.6665 9.99996C1.6665 5.39759 5.39746 1.66663 9.99984 1.66663C14.6022 1.66663 18.3332 5.39759 18.3332 9.99996C18.3332 14.6023 14.6022 18.3333 9.99984 18.3333Z" stroke="#10B981" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
        </svg>
        <span>{{ session('success') }}</span>
    </div>

    <!-- Desktop View -->
    <div id="success-alert-desktop" class="alert hidden md:flex items-center p-4 mb-4 rounded-md text-sm bg-green-100 text-green-700 border border-green-400 
        max-w-lg fixed top-0 right-0 mt-24 mr-4" role="alert">
        <svg class="w-5 h-5 mr-2" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M10.0043 13.3333V9.16663M9.99984 6.66663H10.0073M9.99984 18.3333C5.39746 18.3333 1.6665 14.6023 1.6665 9.99996C1.6665 5.39759 5.39746 1.66663 9.99984 1.66663C14.6022 1.66663 18.3332 5.39759 18.3332 9.99996C18.3332 14.6023 14.6022 18.3333 9.99984 18.3333Z" stroke="#10B981" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
        </svg>
        <span>{{ session('success') }}</span>
    </div>
@endif

@if ($errors->any())
    <!-- Mobile View -->
    <div id="error-alert" class="alert flex md:hidden items-center p-4 mb-4 rounded-md text-sm bg-red-100 text-red-700 border border-red-400 
        w-[90%] left-1/2 transform -translate-x-1/2 relative m-0" role="alert">
        <svg class="w-5 h-5 mr-2" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M10.0043 13.3333V9.16663M9.99984 6.66663H10.0073M9.99984 18.3333C5.39746 18.3333 1.6665 14.6023 1.6665 9.99996C1.6665 5.39759 5.39746 1.66663 9.99984 1.66663C14.6022 1.66663 18.3332 5.39759 18.3332 9.99996C18.3332 14.6023 14.6022 18.3333 9.99984 18.3333Z" stroke="#F59E0B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
        <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>

    <!-- Desktop View -->
    <div id="error-alert-desktop" class="alert hidden md:flex items-center p-4 mb-4 rounded-md text-sm bg-red-100 text-red-700 border border-red-400 
        max-w-lg fixed top-0 right-0 mt-24 mr-4" role="alert">
        <svg class="w-5 h-5 mr-2" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M10.0043 13.3333V9.16663M9.99984 6.66663H10.0073M9.99984 18.3333C5.39746 18.3333 1.6665 14.6023 1.6665 9.99996C1.6665 5.39759 5.39746 1.66663 9.99984 1.66663C14.6022 1.66663 18.3332 5.39759 18.3332 9.99996C18.3332 14.6023 14.6022 18.3333 9.99984 18.3333Z" stroke="#F59E0B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
        <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- Script to Auto-Hide Alerts -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        setTimeout(() => {
            document.querySelectorAll('.alert').forEach(alert => {
                alert.style.display = 'none';
            });
        }, 3000); // 3 seconds
    });
</script>
        <!-- Image Preview and Upload Icon -->
<div class="flex justify-center mb-4">
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
