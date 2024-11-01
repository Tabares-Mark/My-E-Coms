// Delete.js
import React from 'react';

const Delete = ({ productId, onDeleteSuccess }) => {
  const deleteProduct = async () => {
    const token = localStorage.getItem('token');

    try {
      const response = await fetch(`http://127.0.0.1:8000/api/product/${productId}`, {
        method: 'DELETE',
        headers: {
          'Content-Type': 'application/json',
          'Authorization': `Bearer ${token}`
        },
      });

      if (!response.ok) throw new Error('Failed to delete product');

      alert('Product deleted successfully');
      onDeleteSuccess(productId);  // Notify ProductList to update the list
    } catch (error) {
      alert(`Error: ${error.message}`);
    }
  };

  return (
    <button onClick={deleteProduct} className="delete-button">
      Delete
    </button>
  );
};

export default Delete;
