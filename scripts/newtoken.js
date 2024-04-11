const config = JSON.parse(fs.readFileSync('conf.json'));
const clientSecret = config.clientId;
const clientId = config.clientSecret;

// api URL https://api.spotify.com/v1/
function newToken() {
    const clientId = '';
    const clientSecret = '';
    // Utilisation de btoa pour encoder en base64
    const token = btoa(`${clientId}:${clientSecret}`);

    const headers
    const body = {
        grant_type: 'client_credentials'
    }

    fetch('https://accounts.spotify.com/api/token', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
            'Authorization': `Basic ${token}`
        },
        body: JSON.stringify(body)
    })
    .then(response => response.json())
}