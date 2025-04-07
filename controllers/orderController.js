// ...existing code...

const markOrderAsPaid = async (req, res) => {
  try {
    const { orderId } = req.params;
    
    const result = await db.query(
      'UPDATE orders SET payment_status = $1 WHERE id = $2 RETURNING *',
      ['paid', orderId]
    );
    
    if (result.rows.length === 0) {
      return res.status(404).json({ message: 'Order not found' });
    }
    
    return res.status(200).json({ 
      success: true, 
      message: 'Order marked as paid',
      order: result.rows[0]
    });
  } catch (error) {
    console.error('Error marking order as paid:', error);
    return res.status(500).json({ message: 'Server error' });
  }
};

const markOrderAsDelivered = async (req, res) => {
  try {
    const { orderId } = req.params;
    
    const result = await db.query(
      'UPDATE orders SET delivery_status = $1 WHERE id = $2 RETURNING *',
      ['delivered', orderId]
    );
    
    if (result.rows.length === 0) {
      return res.status(404).json({ message: 'Order not found' });
    }
    
    return res.status(200).json({ 
      success: true, 
      message: 'Order marked as delivered',
      order: result.rows[0]
    });
  } catch (error) {
    console.error('Error marking order as delivered:', error);
    return res.status(500).json({ message: 'Server error' });
  }
};

// ...existing code...

module.exports = {
  // ...existing code...
  markOrderAsPaid,
  markOrderAsDelivered
};
