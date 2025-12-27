# Blog Page

This page is used to display blog content on the frontend.

---

## What is done in this Blog Page

- Blog listing page created
- Top hero section designed (similar to About Us page)
- Blog cards shown in grid layout
- Each blog shows:
  - Featured image
  - Blog title
  - Short content preview
  - Publish date
  - Read more button
- Clicking a blog opens the single blog details page
- SEO-friendly slug based blog URL used
- Responsive design for mobile and desktop
- Bootstrap 5 used for UI
- Blade template used for frontend

---

## Data Used

- Blogs are fetched from database
- Data passed from controller to blade
- Loop used to show blogs dynamically

---

## Notes

- If no blog is found, a message is shown
- Content preview is limited using `Str::limit`
- Images are loaded from uploaded path

---
