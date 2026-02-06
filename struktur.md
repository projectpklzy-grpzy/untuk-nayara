app/
├── Http/
│   ├── Controllers/
│   │   ├── AuthController.php
│   │   ├── ExperienceController.php
│   │   └── GalleryController.php
│   └── Models/
│       ├── Photo.php
│       └── Message.php
database/
├── migrations/
│   ├── 2024_01_01_000001_create_photos_table.php
│   └── 2024_01_01_000002_create_messages_table.php
├── seeders/
└── factories/
resources/views/
├── layouts/
│   └── app.blade.php
├── pages/
│   ├── welcome.blade.php
│   ├── login.blade.php
│   ├── loading.blade.php
│   ├── quiz.blade.php
│   ├── upload.blade.php
│   ├── letter.blade.php
│   └── closing.blade.php
└── components/
public/
├── assets/
│   ├── images/
│   │   ├── background.jpg
│   │   ├── photo-placeholder.png
│   │   └── love.png
│   └── icons/
│       ├── heart.svg
│       ├── check.svg
│       └── close.svg
├── css/
│   └── app.css
├── js/
│   └── app.js
└── uploads/
    └── photos/