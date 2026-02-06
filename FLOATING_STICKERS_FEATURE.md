# 🎨 Floating Stickers - Romantic Letter Page

## ✨ Fitur Baru

### 🎪 Stiker Mengambang
Halaman romantic-letter sekarang memiliki **12 stiker lucu** yang mengambang di background!

### 📦 Stiker yang Digunakan (dari `/public/icons/`)
1. 💐 **buket.png** - Buket bunga
2. 🌙 **bulan.png** - Bulan
3. 🌸 **bunga.png** - Bunga
4. 🦋 **kupu-kupu.png** - Kupu-kupu
5. 💕 **love.png** - Love/heart
6. 🎀 **pita.png** - Pita

**Total**: 6 jenis stiker × 2 instance = **12 stiker mengambang**

---

## 🎭 Animasi Detail

### 1. **Entrance Animation**
- Scale dari 0 → 1
- Rotate random (0-360deg) → 0deg
- Opacity 0 → 0.6
- Duration: 0.8s dengan cubic-bezier bounce
- Staggered timing: 300ms per jenis stiker

### 2. **Floating Animation**
- Naik-turun halus (float)
- Duration: 4-7 detik (random)
- Delay: 0-2 detik (random)
- Infinite loop

### 3. **Rotation Animation**
- Rotate: 0deg → 5deg → 0deg → -5deg → 0deg
- Duration: 8-14 detik (2x float duration)
- Smooth ease-in-out
- Infinite loop

### 4. **Visual Effects**
- Drop shadow: `0 4px 8px rgba(242, 161, 179, 0.2)`
- Opacity: 0.6 (semi-transparent)
- Size: 40-80px (random)
- Position: Random di seluruh layar

---

## 🎯 Layout

```
┌─────────────────────────────────────┐
│  🌸      🦋         💕      🌙      │
│                                     │
│      💐        ✉️ SURAT      🎀    │
│           (center, z-index: 1)     │
│                                     │
│  🎀      🌸         🦋      💐      │
└─────────────────────────────────────┘

Background stickers: z-index: 0
Envelope: z-index: 1
Modal: z-index: 1000
```

---

## 💡 Technical Details

### Positioning
- **Container**: Fixed, full screen
- **Stickers**: Absolute positioning
- **Random placement**: 0-100% left & top
- **Pointer events**: None (tidak mengganggu klik)

### Performance
- **GPU accelerated**: transform & opacity
- **Staggered loading**: 300ms delay per type
- **Optimized animations**: CSS-based
- **No layout reflow**: position absolute

### Responsiveness
- Stiker menyesuaikan dengan ukuran layar
- Random positioning tetap proporsional
- Mobile-friendly (tidak terlalu banyak)

---

## 🎨 Customization

### Mengubah Jumlah Stiker
Edit loop di `romantic-letter.blade.php`:

```javascript
for(let i = 0; i < 2; i++) {  // Ubah angka 2
    // Create sticker
}
```

### Mengubah Ukuran
Edit di `createFloatingStickers()`:

```javascript
width: ${40 + Math.random() * 40}px;  // Min 40px, Max 80px
```

### Mengubah Opacity
Edit di animasi:

```javascript
sticker.style.opacity = '0.6';  // 0.0 - 1.0
```

---

## ✨ Result

Halaman romantic-letter sekarang:
- 🎨 **Lebih hidup** dengan stiker mengambang
- 💕 **Lebih romantis** dengan elemen visual
- 🎪 **Lebih playful** dengan animasi smooth
- ✨ **Lebih engaging** tanpa mengganggu konten

**Stiker mengambang membuat suasana lebih magical!** 🌟
