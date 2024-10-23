document.addEventListener('DOMContentLoaded', function() {
    fetch('checkSession.php')
        .then(response => response.json())
        .then(data => {
            if (data.loggedin && data.role === 'admin') {
                document.getElementById('admin-options').style.display = 'block';
            }
        });
});
