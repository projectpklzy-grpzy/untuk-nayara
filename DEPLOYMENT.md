# 🚀 Deployment Guide - Romantic Experience

## ✅ Pilihan Terbaik: Railway.app

### Langkah Deploy (5 menit):

1. **Push ke GitHub**
   ```bash
   git init
   git add .
   git commit -m "Initial commit"
   git branch -M main
   git remote add origin https://github.com/username/untk-nay.git
   git push -u origin main
   ```

2. **Deploy ke Railway**
   - Buka https://railway.app
   - Login dengan GitHub
   - Klik "New Project" → "Deploy from GitHub repo"
   - Pilih repository `untk-nay`
   - Railway akan auto-detect Laravel dan deploy

3. **Set Environment Variables di Railway**
   ```
   APP_KEY=base64:QCkBxpH8HCocGspET8kQnhBM+EmpmIDPg9gTIxSzWo8=
   APP_ENV=production
   APP_DEBUG=false
   DB_CONNECTION=sqlite
   DB_DATABASE=/app/database/database.sqlite
   SESSION_DRIVER=file
   CACHE_STORE=file
   ```

4. **Generate Domain**
   - Di Railway dashboard → Settings → Generate Domain
   - Dapatkan URL: `https://untk-nay.up.railway.app`

---

## 🎯 Alternatif Lain (Gratis):

### 1. **Render.com** (Recommended #2)
- Free tier: 750 jam/bulan
- Auto-deploy dari GitHub
- Database PostgreSQL gratis
- Setup: https://render.com

### 2. **Fly.io**
- Free tier: 3 shared-cpu VMs
- Global CDN
- Setup lebih teknis
- https://fly.io

### 3. **Heroku** (Tidak gratis lagi)
- Dulu gratis, sekarang $5/bulan minimum

---

## 📝 File yang Sudah Disiapkan:

✅ `Procfile` - Railway start command
✅ `nixpacks.toml` - Build configuration
✅ `.env.production` - Production environment template
✅ `database.sqlite` - SQLite database (no external DB needed)

---

## 🔒 Keamanan:

- ✅ APP_DEBUG=false di production
- ✅ APP_KEY sudah di-generate
- ✅ SQLite untuk simplicity (data tersimpan di file)
- ✅ Session driver: file
- ✅ HTTPS otomatis dari Railway

---

## 🎨 Setelah Deploy:

1. Test semua halaman
2. Upload foto akan tersimpan di `storage/app/public`
3. Jika perlu persistent storage, upgrade Railway plan

---

## 💡 Tips:

- Railway free tier: $5 credit/bulan (cukup untuk 500+ jam)
- Jika credit habis, bisa pindah ke Render.com
- Untuk production serius, pertimbangkan shared hosting ($2-5/bulan)

---

## 🆘 Troubleshooting:

**Error: Storage not writable**
```bash
chmod -R 775 storage bootstrap/cache
```

**Error: APP_KEY not set**
```bash
php artisan key:generate --show
# Copy output ke Railway environment variables
```

**Database error**
- Pastikan `database.sqlite` ada di repository
- Atau set DB_CONNECTION=sqlite di Railway

---

## 📞 Support:

Jika ada masalah saat deploy, cek:
1. Railway logs: Dashboard → Deployments → View Logs
2. Laravel logs: `storage/logs/laravel.log`

Good luck! 🚀💖
