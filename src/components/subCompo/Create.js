import React, { useState } from 'react';

const Create = ({ onClose }) => {
  const [name, setName] = useState('');
  const [price, setPrice] = useState(0);
  const [quantity, setQuantity] = useState(0);
  const [category, setCategory] = useState('');
  const [description, setDescription] = useState('');

  const AddProduct = async (e) => {
    e.preventDefault();

    const token = localStorage.getItem('token');

    try {
      const response = await fetch('http://127.0.0.1:8000/api/product', {
        method: 'POST',
        headers: {  // Corrected here
          'Content-Type': 'application/json',
          'Authorization': `Bearer ${token}`,
        },
        body: JSON.stringify({
          name,
          price,
          quantity,
          category,
          description,
        }),
      });

      const data = await response.json();
      if (!response.ok) throw new Error(data.message || 'Failed to add product');
      else alert(data.message || 'Product added successfully');

      onClose();
    } catch (error) {
      alert(`Error: ${error.message}`);
    }
  };

  return (
    <div className='CreateForm'>
      <form onSubmit={AddProduct}>
        <h2>Adding a Product</h2>

        <label>Name</label>
        <input type='text' value={name} onChange={(e) => setName(e.target.value)} placeholder='Enter Product Name' />

        <br />

        <label>Price</label>
        <input type='number' value={price} onChange={(e) => setPrice(Number(e.target.value))} placeholder='Enter Product Price' />

        <br />

        <label>Quantity</label>
        <input type='number' value={quantity} onChange={(e) => setQuantity(Number(e.target.value))} placeholder='Enter Product Quantity' />

        <br />

        <label>Category</label>
        <input type='text' value={category} onChange={(e) => setCategory(e.target.value)} placeholder='Enter Product Category' />

        <br />

        <label>Description</label>
        <input type='text' value={description} onChange={(e) => setDescription(e.target.value)} placeholder='Enter Product Description' />

        <br />

        <button type='submit'>Add Product</button>
      </form>
    </div>
  );
}

export default Create;
