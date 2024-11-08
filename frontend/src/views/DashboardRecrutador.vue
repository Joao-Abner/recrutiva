<template>
    <div class="job-listings">
      <h1>Jobs</h1>
  
      <!-- Barra de Filtros -->
      <div class="filters">
        <button>All (16)</button>
        <button>Published (7)</button>
        <button>Draft (1)</button>
        <button>Trash (10)</button>
        <button>Expired (1)</button>
  
        <select>
          <option>Bulk Actions</option>
          <option>Delete</option>
          <option>Publish</option>
        </select>
        <button>Apply</button>
        
        <select>
          <option>All dates</option>
          <!-- Add more date options if needed -->
        </select>
  
        <select>
          <option>Select category</option>
          <!-- Add more categories if needed -->
        </select>
        <button>Filter</button>
      </div>
  
      <!-- Tabela de Vagas -->
      <table class="jobs-table">
        <thead>
          <tr>
            <th>Type</th>
            <th>Position</th>
            <th>Location</th>
            <th>Posted</th>
            <th>Expires</th>
            <th>Categories</th>
            <th><span class="star-icon">★</span></th>
            <th><span class="user-icon">👤</span></th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><span class="job-type-full-time">Full Time</span></td>
            <td>Senior Product Designer</td>
            <td>San Mateo</td>
            <td><span class="status-icon status-published">✔</span> Jan 20, 2014 by admin</td>
            <td>Feb 19, 2014</td>
            <td>Test 2</td>
            <td>-</td>
            <td>-</td>
            <td>
              <button class="actions-button"><i>👁️</i></button>
              <button class="actions-button"><i>✏️</i></button>
              <button class="actions-button"><i>🗑️</i></button>
            </td>
          </tr>
          <tr>
            <td><span class="job-type-part-time">Part Time</span></td>
            <td>Front End Developer</td>
            <td>Potrero Hill</td>
            <td><span class="status-icon status-published">✔</span> Jan 20, 2014 by admin</td>
            <td>-</td>
            <td>-</td>
            <td><span class="star-icon">★</span></td>
            <td>-</td>
            <td>
              <button class="actions-button"><i>👁️</i></button>
              <button class="actions-button"><i>✏️</i></button>
              <button class="actions-button"><i>🗑️</i></button>
            </td>
          </tr>
          <!-- Adicione mais linhas conforme necessário -->
        </tbody>
      </table>
    </div>
  </template>
  
  <script>
  export default {
    name: "JobListings",
  };
  </script>
  
  <style scoped>
  /* Estilo básico da tabela */
  .jobs-table {
    width: 100%;
    border-collapse: collapse;
    font-family: Arial, sans-serif;
    font-size: 14px;
    color: #333;
  }
  
  /* Cabeçalho da tabela */
  .jobs-table thead th {
    background-color: #f5f5f5;
    padding: 10px;
    border-bottom: 2px solid #e0e0e0;
    text-align: left;
    font-weight: bold;
  }
  
  /* Linhas da tabela */
  .jobs-table tbody tr {
    border-bottom: 1px solid #e0e0e0;
  }
  
  /* Cores das linhas alternadas */
  .jobs-table tbody tr:nth-child(even) {
    background-color: #f9f9f9;
  }
  
  /* Células da tabela */
  .jobs-table tbody td {
    padding: 10px;
    vertical-align: middle;
  }
  
  /* Estilo para o botão de ações */
  .actions-button {
    background-color: #f0f0f0;
    border: none;
    cursor: pointer;
    padding: 5px;
    margin: 0 2px;
    border-radius: 3px;
    color: #333;
    font-size: 12px;
  }
  
  /* Ícones de ação */
  .actions-button i {
    font-size: 14px;
    vertical-align: middle;
  }
  
  /* Estilos específicos para os tipos de emprego */
  .job-type-full-time {
    color: white;
    background-color: #5cb85c;
    padding: 5px 10px;
    border-radius: 3px;
    font-weight: bold;
  }
  
  .job-type-part-time {
    color: white;
    background-color: #f0ad4e;
    padding: 5px 10px;
    border-radius: 3px;
    font-weight: bold;
  }
  
  .job-type-freelance {
    color: white;
    background-color: #5bc0de;
    padding: 5px 10px;
    border-radius: 3px;
    font-weight: bold;
  }
  
  /* Outros elementos específicos */
  .star-icon {
    color: #ffc107;
  }
  
  .user-icon {
    color: #007bff;
  }
  
  /* Ícones de status */
  .status-icon {
    font-size: 14px;
    margin-right: 5px;
  }
  
  .status-published {
    color: #5cb85c;
  }
  
  .status-draft {
    color: #f0ad4e;
  }
  
  .status-expired {
    color: #d9534f;
  }
  
  /* Barra de Filtros */
  .filters {
    margin-bottom: 20px;
  }
  
  .filters button,
  .filters select {
    margin-right: 10px;
    padding: 5px;
    border-radius: 3px;
    border: 1px solid #ccc;
    cursor: pointer;
  }
  
  .filters button {
    background-color: #e7e7e7;
  }
  </style>
  