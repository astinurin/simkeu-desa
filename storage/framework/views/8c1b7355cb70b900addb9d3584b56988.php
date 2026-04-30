<?php $__env->startSection('content'); ?>
    <div class="container-fluid">

        <h1 class="h3 mb-4 text-gray-800">Profile</h1>

        <div class="row">

            <!-- Profile Info -->
            <div class="col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            Informasi Profil
                        </h6>
                    </div>
                    <div class="card-body">
                        <?php echo $__env->make('profile.partials.update-profile-information-form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    </div>
                </div>
            </div>

            <!-- Update Password -->
            <div class="col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-warning">
                            Update Password
                        </h6>
                    </div>
                    <div class="card-body">
                        <?php echo $__env->make('profile.partials.update-password-form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    </div>
                </div>
            </div>

            <!-- Delete Account -->
            <div class="col-lg-12">
                <div class="card shadow mb-4 border-left-danger">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-danger">
                            Hapus Akun
                        </h6>
                    </div>
                    <div class="card-body">
                        <?php echo $__env->make('profile.partials.delete-user-form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script>
        let cropper;

        const photoInput = document.getElementById('photo-input');
        const cropImage = document.getElementById('crop-image');
        const previewImage = document.getElementById('preview-image');
        const hiddenInput = document.getElementById('cropped_image');

        photoInput.addEventListener('change', function (e) {
            const file = e.target.files[0];
            if (!file) return;

            const reader = new FileReader();

            reader.onload = function (event) {
                cropImage.src = event.target.result;

                // tunggu image beneran loaded
                cropImage.onload = function () {
                    $('#cropModal').modal('show');
                };
            };

            reader.readAsDataURL(file);
        });


        $('#cropModal').on('shown.bs.modal', function () {

            setTimeout(() => {

                if (cropper) {
                    cropper.destroy();
                    cropper = null;
                }

                cropper = new Cropper(cropImage, {
                    aspectRatio: 1,
                    viewMode: 0,
                    dragMode: 'move',

                    autoCropArea: 0.55,

                    cropBoxMovable: false,
                    cropBoxResizable: false,

                    movable: true,
                    zoomable: true,
                    zoomOnWheel: false,

                    guides: false,
                    center: false,
                    highlight: false,
                    background: false,

                    responsive: true
                });

                console.log("Cropper initialized:", cropper);

            }, 300); // tunggu modal bootstrap selesai animasi
        });


        $('#cropModal').on('hidden.bs.modal', function () {
            if (cropper) {
                cropper.destroy();
                cropper = null;
            }

            photoInput.value = '';
        });


        document.getElementById('zoom-in').addEventListener('click', function () {
            if (cropper) {
                cropper.zoom(0.1);
            }
        });

        document.getElementById('zoom-out').addEventListener('click', function () {
            if (cropper) {
                cropper.zoom(-0.1);
            }
        });


        document.getElementById('crop-button').addEventListener('click', function () {
            if (!cropper) return;

            const canvas = cropper.getCroppedCanvas({
                width: 300,
                height: 300
            });

            const croppedData = canvas.toDataURL('image/png');

            previewImage.src = croppedData;
            hiddenInput.value = croppedData;

            $('#cropModal').modal('hide');
        });
    </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Asti\Kuliah\SMT 8\skripsi\simkeu-desa\resources\views/profile/edit.blade.php ENDPATH**/ ?>