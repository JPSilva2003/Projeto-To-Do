// 📡 Escuta eventos de push enviados pelo servidor
self.addEventListener('push', function(event) {
    let data = {
        title: '📢 Notificação',
        body: 'Você recebeu uma nova notificação.',
        url: '/'
    };

    // Tenta extrair os dados JSON da notificação
    if (event.data) {
        try {
            const json = event.data.json();
            data.title = json.title || data.title;
            data.body = json.body || data.body;
            data.url = json.url || data.url;
        } catch (error) {
            console.warn('⚠️ Dados do push inválidos, usando valores padrão.');
        }
    }

    const options = {
        body: data.body,
        icon: '/icons/icon-192x192.png',
        badge: '/icons/badge-72x72.png',
        data: {
            url: data.url
        }
    };

    event.waitUntil(
        self.registration.showNotification(data.title, options)
    );
});

// 🧭 Quando o usuário clica na notificação, abre ou foca a janela
self.addEventListener('notificationclick', function(event) {
    event.notification.close();

    event.waitUntil(
        clients.matchAll({ type: 'window', includeUncontrolled: true }).then(function(clientList) {
            const urlToOpen = event.notification?.data?.url || '/';

            // Se já há uma aba com essa URL, foca nela
            for (const client of clientList) {
                if (client.url === urlToOpen && 'focus' in client) {
                    return client.focus();
                }
            }

            // Se não, abre uma nova
            if (clients.openWindow) {
                return clients.openWindow(urlToOpen);
            }
        })
    );
});
