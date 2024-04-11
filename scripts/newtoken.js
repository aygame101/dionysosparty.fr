function newToken() {
    const clientId = '';
    const clientSecret = '';
    // Utilisation de btoa pour encoder en base64
    const token = btoa(`${clientId}:${clientSecret}`);

    axios({
        method: 'post',
        url: 'https://accounts.spotify.com/api/token',
        params: {
            grant_type: 'client_credentials',
        },
        headers: {
            Authorization: `Basic ${token}`,
        },
    })
    .then((response) => {
        // Ici, mettez à jour l'élément HTML avec le token
        document.getElementById('token').innerText = `Token: ${response.data.access_token}`;
    })
    .catch((error) => {
        console.error(error);
    });
}
