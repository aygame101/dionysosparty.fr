// Script pour vider la file d'attente de musiques

function clearQueue() {
    // On vide la file d'attente
    queue = [];
    // On envoie un message de confirmation
    message.channel.send("La file d'attente a été vidée.");
}