
<script>
   // Send data to the parent window
    window.opener.postMessage(@json($data), "{{ route('registration') }}");
    // write code for storing session data in javascript
    // window.opener.sessionStorage.setItem('registration', @json($data));
    window.close();
</script>
