async function markOrderAsPaid(orderId) {
  try {
    const response = await fetch(`/api/orders/${orderId}/mark-paid`, {
      method: 'PATCH',
      headers: {
        'Content-Type': 'application/json'
      }
    });
    
    const data = await response.json();
    
    if (data.success) {
      alert('Order has been marked as paid');
      location.reload(); // Refresh to show updated status
    } else {
      alert('Failed to update order: ' + data.message);
    }
  } catch (error) {
    console.error('Error:', error);
    alert('An error occurred while updating the order');
  }
}

async function markOrderAsDelivered(orderId) {
  try {
    const response = await fetch(`/api/orders/${orderId}/mark-delivered`, {
      method: 'PATCH',
      headers: {
        'Content-Type': 'application/json'
      }
    });
    
    const data = await response.json();
    
    if (data.success) {
      alert('Order has been marked as delivered');
      location.reload(); // Refresh to show updated status
    } else {
      alert('Failed to update order: ' + data.message);
    }
  } catch (error) {
    console.error('Error:', error);
    alert('An error occurred while updating the order');
  }
}
