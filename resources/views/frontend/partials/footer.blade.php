<script src="{{ asset('/frontend/js/custom.js') }}"></script>
<script type="text/javascript"
    src="{{ asset('/frontend/js/revolution-slider/js/extensions/revolution.extension.actions.min.js') }}"></script>
<script type="text/javascript"
    src="{{ asset('/frontend/js/revolution-slider/js/extensions/revolution.extension.carousel.min.js') }}"></script>
<script type="text/javascript"
    src="{{ asset('/frontend/js/revolution-slider/js/extensions/revolution.extension.kenburn.min.js') }}"></script>
<script type="text/javascript"
    src="{{ asset('/frontend/js/revolution-slider/js/extensions/revolution.extension.layeranimation.min.js') }}">
</script>
<script type="text/javascript"
    src="{{ asset('/frontend/js/revolution-slider/js/extensions/revolution.extension.migration.min.js') }}"></script>
<script type="text/javascript"
    src="{{ asset('/frontend/js/revolution-slider/js/extensions/revolution.extension.navigation.min.js') }}"></script>
<script type="text/javascript"
    src="{{ asset('/frontend/js/revolution-slider/js/extensions/revolution.extension.parallax.min.js') }}"></script>
<script type="text/javascript"
    src="{{ asset('/frontend/js/revolution-slider/js/extensions/revolution.extension.slideanims.min.js') }}"></script>
<script type="text/javascript"
    src="{{ asset('/frontend/js/revolution-slider/js/extensions/revolution.extension.video.min.js') }}"></script>
<script>
    $(document).ready(function() {

        let successMsg = "{{ session('success') }}"
        let errorMsg = "{{ session('error') }}"
        if (successMsg) {
            Swal.fire('Success!', successMsg, 'success');
            $('html, body').animate({
                scrollTop: $("#donors").offset().top
            }, 1000);
        }
        if (errorMsg) {
            Swal.fire('Error!', errorMsg, 'error');
        }


    });

    function scrollToElement(elementId) {
        const element = document.getElementById(elementId);
        if (element) {
            const offsetTop = element.getBoundingClientRect().top + window.pageYOffset;

            window.scrollTo({
                top: offsetTop,
                behavior: 'smooth' // "smooth" for smooth scrolling, "auto" for instant scrolling
            });
        }
    }
</script>


@yield('scripts')

</html>
