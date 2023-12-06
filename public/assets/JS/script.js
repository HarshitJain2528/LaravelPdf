// downloadActions.js
function setAction(type) {
    var form = document.getElementById('downloadForm');
    if (type === 'pdf') {
        form.action = '{{route("upload.csv")}}';
        form.submit();
    } else if (type === 'images') {
        form.action = '{{ route("download.images") }}';
        form.submit();
    }
}
