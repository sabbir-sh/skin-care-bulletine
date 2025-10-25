@extends('backend.layouts.app')

@section('content')
<style>
    /* Basic Reset and Variables */
    :root {
        --primary-color: #007bff;
        --secondary-color: #6c757d;
        --success-color: #28a745;
        --danger-color: #dc3545;
        --card-bg: #ffffff;
        --body-bg: #f8f9fa;
        --border-color: #e9ecef;
    }

    body {
        font-family: 'Arial', sans-serif;
        background-color: var(--body-bg);
        margin: 0;
        padding: 0;
    }

    /* Main Container */
    .dashboard-container {
        padding: 20px;
    }

    /* Header */
    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .header h1 {
        color: #343a40;
        margin: 0;
    }

    .header .btn-primary {
        background-color: var(--primary-color);
        color: white;
        padding: 10px 15px;
        text-decoration: none;
        border-radius: 5px;
        font-weight: bold;
    }

    /* Stats Grid */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .stat-card {
        background-color: var(--card-bg);
        border-left: 5px solid var(--primary-color); /* Emphasize with border */
        border-radius: 8px;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
        transition: transform 0.2s;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
    }

    .stat-card.success { border-left-color: var(--success-color); }
    .stat-card.danger { border-left-color: var(--danger-color); }
    .stat-card.secondary { border-left-color: var(--secondary-color); }

    .stat-card .title {
        font-size: 14px;
        color: var(--secondary-color);
        margin-bottom: 5px;
        text-transform: uppercase;
    }

    .stat-card .value {
        font-size: 28px;
        font-weight: bold;
        color: #343a40;
    }

    /* Content Area (Recent Activity/Table) */
    .content-card {
        background-color: var(--card-bg);
        border-radius: 8px;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
    }

    .content-card h2 {
        border-bottom: 1px solid var(--border-color);
        padding-bottom: 10px;
        margin-top: 0;
        margin-bottom: 15px;
        color: var(--primary-color);
        font-size: 20px;
    }

    /* Table Styling (Simple) */
    .data-table {
        width: 100%;
        border-collapse: collapse;
    }

    .data-table th, .data-table td {
        padding: 12px 15px;
        text-align: left;
        border-bottom: 1px solid var(--border-color);
    }

    .data-table th {
        background-color: #f1f1f1;
        color: #343a40;
        font-weight: 600;
    }

    .data-table tbody tr:hover {
        background-color: #f5f5f5;
    }
</style>

<div class="dashboard-container">
    <div class="header">
        <h1>Dashboard Overview 👋</h1>
        <a href="#" class="btn-primary">Add New Item</a>
    </div>

    <div class="stats-grid">
        <div class="stat-card">
            <div class="title">Total Users</div>
            <div class="value">2,500</div>
        </div>
        <div class="stat-card success">
            <div class="title">Revenue (This Month)</div>
            <div class="value">$12,450</div>
        </div>
        <div class="stat-card danger">
            <div class="title">Pending Orders</div>
            <div class="value">15</div>
        </div>
        <div class="stat-card secondary">
            <div class="title">Products Listed</div>
            <div class="value">548</div>
        </div>
    </div>
    
    <hr style="border: 0; border-top: 1px solid var(--border-color); margin: 30px 0;">

    <div class="content-card">
        <h2>Recent Activity/Orders</h2>
        <table class="data-table">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer Name</th>
                    <th>Status</th>
                    <th>Amount</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>#1001</td>
                    <td>Mr. John Doe</td>
                    <td><span style="color: var(--success-color);">Completed</span></td>
                    <td>$450.00</td>
                    <td>2025-10-25</td>
                </tr>
                <tr>
                    <td>#1002</td>
                    <td>Ms. Jane Smith</td>
                    <td><span style="color: var(--primary-color);">Processing</span></td>
                    <td>$120.50</td>
                    <td>2025-10-24</td>
                </tr>
                <tr>
                    <td>#1003</td>
                    <td>Abeer Ahmed</td>
                    <td><span style="color: var(--danger-color);">Cancelled</span></td>
                    <td>$75.00</td>
                    <td>2025-10-23</td>
                </tr>
            </tbody>
        </table>
    </div>

</div>

@endsection