import React, { useState, useEffect } from 'react';
import Delete from './Delete';
import Update from './Update';

function ProductList({ url }) {
  const [products, setProducts] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);
  const [selectedProduct, setSelectedProduct] = useState(null);
  const [showUpdate, setShowUpdate] = useState(false);

  const fetchProducts = async () => {
    const token = localStorage.getItem('token');

    try {
      const response = await fetch(url, {
        method: 'GET',
        headers: {
          'Content-Type': 'application/json',
          'Authorization': `Bearer ${token}`
        }
      });
      if (!response.ok) throw new Error('Fetching Failed');
      const data = await response.json();
      setProducts(data.data);
    } catch (error) {
      setError(error.message);
    } finally {
      setLoading(false);
    }
  };

  useEffect(() => {
    fetchProducts();
  }, [url]);

  const handleDeleteSuccess = (deletedId) => {
    setProducts(products.filter(product => product.id !== deletedId));
  };

  const handleUpdateSuccess = () => {
    fetchProducts();
    setShowUpdate(false);
  };

  const openUpdateModal = (product) => {
    console.log("Selected Product for Update:", product);
    setSelectedProduct(product);
    setShowUpdate(true);
  };

  console.log("Show Update Modal:", showUpdate); // Debugging

  if (loading) return <p>Loading...</p>;
  if (error) return <p>Error: {error}</p>;

  return (
    <div>
      {products.length === 0 ? (
        <p>No products available</p>
      ) : (
        products.map(product => (
          <div key={product.id}>
            <h3>{product.name}</h3>
            <ul>
              <li>Price: ${product.price}</li>
              <li>Quantity: {product.quantity}</li>
              <li>Category: {product.category}</li>
              <li>Description: {product.description}</li>

            </ul>
            <Delete productId={product.id} onDeleteSuccess={handleDeleteSuccess} />
            <button onClick={() => openUpdateModal(product)}>Update</button>
          </div>
        ))
      )}
      {showUpdate && selectedProduct && (
        <div className="modal">
          <div className="modal-content">
            <Update 
              product={selectedProduct} 
              onClose={() => setShowUpdate(false)} 
              onUpdateSuccess={handleUpdateSuccess} 
            />
          </div>
        </div>
      )}
    </div>
  );
}

export default ProductList;
