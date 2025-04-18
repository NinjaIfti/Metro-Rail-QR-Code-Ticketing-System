import './bootstrap';
function payForTicket(ticketId) {
    // Show payment modal
    openPaymentModal();

    // Simulate payment processing (would be a real payment gateway in production)
    setTimeout(function() {
        // Hide spinner
        document.getElementById('payment-loading').classList.add('hidden');

        // Process payment via AJAX
        fetch(`/tickets/${ticketId}/process-payment`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                ticket_id: ticketId
            })
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Show success message
                    document.getElementById('payment-success').classList.remove('hidden');
                    document.getElementById('payment-message').classList.add('hidden');

                    // Reload the page after 3 seconds
                    setTimeout(function() {
                        closePaymentModal();
                        window.location.reload();
                    }, 3000);
                } else {
                    document.getElementById('payment-message').textContent = data.message || 'Payment failed. Please try again.';
                }
            })
            .catch(error => {
                document.getElementById('payment-message').textContent = 'Payment failed. Please try again.';
                console.error('Error processing payment:', error);
            });
    }, 2000); // 2 second delay to simulate payment processing
}

function openPaymentModal() {
    document.getElementById('paymentModal').classList.remove('hidden');
    document.body.classList.add('overflow-hidden');
}

function closePaymentModal() {
    document.getElementById('paymentModal').classList.add('hidden');
    document.getElementById('payment-success').classList.add('hidden');
    document.getElementById('payment-loading').classList.remove('hidden');
    document.getElementById('payment-message').classList.remove('hidden');
    document.getElementById('payment-message').textContent = 'Processing payment...';
    document.body.classList.remove('overflow-hidden');
}

// Modify your store function to handle "Pay Now" option with AJAX
document.addEventListener('DOMContentLoaded', function() {
    const ticketForm = document.querySelector('form[action*="tickets.store"]');

    if (ticketForm) {
        ticketForm.addEventListener('submit', function(e) {
            const paymentOption = document.querySelector('input[name="payment_option"]:checked').value;

            if (paymentOption === 'pay_now') {
                e.preventDefault();

                // Show payment modal
                openPaymentModal();

                // Get form data
                const formData = new FormData(this);

                // Simulate payment processing
                setTimeout(function() {
                    // Submit the form via AJAX
                    fetch(ticketForm.action, {
                        method: 'POST',
                        body: formData
                    })
                        .then(response => response.json())
                        .then(data => {
                            // Hide spinner
                            document.getElementById('payment-loading').classList.add('hidden');

                            if (data.success) {
                                // Show success message
                                document.getElementById('payment-success').classList.remove('hidden');
                                document.getElementById('payment-message').classList.add('hidden');

                                // Redirect to tickets page after 3 seconds
                                setTimeout(function() {
                                    closePaymentModal();
                                    closeTicketModal('create');
                                    window.location.href = '/tickets';
                                }, 3000);
                            } else {
                                document.getElementById('payment-message').textContent = data.message || 'Payment failed. Please try again.';
                            }
                        })
                        .catch(error => {
                            document.getElementById('payment-message').textContent = 'Payment failed. Please try again.';
                            console.error('Error processing payment:', error);
                        });
                }, 2000); // 2 second delay to simulate payment processing
            }
        });
    }
});
