# Blood Fighters

**Blood Fighters** হলো একটি রক্তদাতা ও রক্তগ্রুপ ম্যানেজমেন্ট সিস্টেম।  
এই প্রজেক্টটি Laravel এবং Blade ব্যবহার করে তৈরি করা হয়েছে, যেখানে রক্তদাতা ডাটাবেস, ড্যাশবোর্ড, এবং ফ্রন্টএন্ড ডোনার লিস্টিং রয়েছে।  

---

## 🔹 Features

### Backend / Admin Panel
- রক্তদাতা CRUD (Create, Read, Update, Delete)  
- Blood Group CRUD  
- Datatable integration for donors list  
- Status management: Approved / Pending  
- Availability status for donors  
- Image upload for donors  
- District, Upazila, Union, Village support  

### Frontend
- Donor listing page by Blood Group  
- Display donor details: Name, Email, Phone, Blood Group, DOB, Gender, Last Donation, Location  
- Call button for quick contact  
- Union + Village + Upazila + District inline display  
- Availability indicator (Available / Not Available)  
- Responsive card layout with hover effects  

### Extras
- JSON-based districts, upazilas, Dhaka city areas  
- Blade templates with reusable forms (create/edit same template)  
- Inline CSS for frontend donor cards  
- Avatar fallback if donor image not uploaded  

---

## 🔹 Installation

1. Clone the repository
```bash
git clone https://github.com/yourusername/blood-fighters.git
cd blood-fighters
