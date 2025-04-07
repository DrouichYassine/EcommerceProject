// ...existing code...

// Mark order as paid (admin only)
router.patch('/orders/:orderId/mark-paid', auth, adminAuth, orderController.markOrderAsPaid);

// Mark order as delivered (admin only)
router.patch('/orders/:orderId/mark-delivered', auth, adminAuth, orderController.markOrderAsDelivered);

// ...existing code...
