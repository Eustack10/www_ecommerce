@if (Session::has('msg'))
<div class="msg animate__animated animate__slideInDown toastify on {{ Session::get('msg')['type'] == 'success' ? 'bg-success' : 'bg-danger' }} toastify-center toastify-top" aria-live="polite" style="transform: translate(0px, 0px); top: 15px;">{{ Session::get('msg')['content'] }}</div>
<script>
    setTimeout(() => {
        document.querySelector('.msg').style.display = 'none';
    }, 5000);
</script>
@endif