# 🎯 Quiz Page - Custom Questions & Playful Features

## ✨ Fitur Baru

### 📝 Pertanyaan Custom
5 pertanyaan yang dirancang khusus untuk menyusun nama "FIJAN":

1. **Pertanyaan 1**: "Apakah kamu tahu siapa yang membuat website lucu ini? Apa ini sial nama orangnya?"
   - Pilihan: A, F, Z, R
   - Jawaban: **F**

2. **Pertanyaan 2**: "Mana yang termasuk huruf vokal?"
   - Pilihan: M, N, I, S
   - Jawaban: **I**

3. **Pertanyaan 3**: "Urutan ke 5 sesudah huruf O"
   - Pilihan: J, L, A, O
   - Jawaban: **J**

4. **Pertanyaan 4**: "Huruf vokal di nama depan kamu"
   - Pilihan: A, I, U, E, O
   - Jawaban: **Semua benar** (opsional)

5. **Pertanyaan 5**: "Sebutkan huruf belakang dari nama orang paling keren se Batujajar"
   - Pilihan: I, S, N, M
   - Jawaban: **N**

**Hasil**: F + I + J + A + N = **FIJAN** ✨

---

## 🎭 Animasi Name Reveal

### Timeline:
```
Semua pertanyaan selesai
    ↓
Quiz fade out
    ↓
Name reveal section muncul
    ↓
Huruf F muncul (scale + rotate)
    ↓ 400ms
Huruf I muncul
    ↓ 400ms
Huruf J muncul
    ↓ 400ms
Huruf A muncul
    ↓ 400ms
Huruf N muncul
    ↓ 500ms
"Calon masa depan kamu 💕" muncul
    ↓ 3 detik
Subtitle fade out
    ↓
Tombol jahil muncul
```

### Animasi Detail:
- **Entrance**: Scale 0 → 1, Rotate -180deg → 0deg
- **Duration**: 0.6s per huruf
- **Easing**: cubic-bezier bounce
- **Text shadow**: Pink glow
- **Font**: Playfair Display, 3rem, bold

---

## 😏 Tombol Jahil

### Behavior:
1. **Click 1-4**: Tombol berpindah tempat random
   - Random X: -75px to +75px
   - Random Y: -50px to +50px
   - Pesan jahil muncul:
     - "Etsss ga kena! 😝"
     - "Coba lagi deh... 😏"
     - "Hampir! Tapi belum 😆"
     - "Sabar ya sayang... 💕"

2. **Click 5**: Tombol bisa diklik
   - Text berubah: "Oke sekarang bisa! Klik aku 💖"
   - Animation: Pulse infinite
   - Redirect ke halaman upload

### Technical:
```javascript
playfulClickCount = 0;

Click 1-4:
  - preventDefault()
  - Move button random
  - Show playful message
  - Increment counter

Click 5:
  - Allow navigation
  - Show loading
  - Redirect to upload page
```

---

## 🎨 Visual Flow

```
┌─────────────────────────────────┐
│   Pertanyaan 1                  │
│   [A] [F] [Z] [R]              │
│   ✓ Benar! → Next              │
└─────────────────────────────────┘
            ↓
┌─────────────────────────────────┐
│   Pertanyaan 2-5                │
│   (Same pattern)                │
└─────────────────────────────────┘
            ↓
┌─────────────────────────────────┐
│   Dari semua jawabanmu...       │
│                                 │
│   F  I  J  A  N                │
│   (animated letters)            │
│                                 │
│   Calon masa depan kamu 💕      │
└─────────────────────────────────┘
            ↓
┌─────────────────────────────────┐
│   [Lanjutkan ke Halaman...]    │
│   (playful button)              │
│                                 │
│   "Etsss ga kena! 😝"          │
└─────────────────────────────────┘
```

---

## 💡 Technical Details

### Question 4 Special Case:
```javascript
// Question 4 - all answers are correct
const isCorrect = questionIndex === 3 || optionIndex === correctIndex;
```

### Answer Storage:
```javascript
correctAnswers = ['F', 'I', 'J', 'A', 'N'];
// Stored as user answers each question
```

### Playful Button Logic:
```javascript
playfulClickCount < 4:
  - Move button
  - Show message
  - Prevent navigation

playfulClickCount === 4:
  - Reset position
  - Change text
  - Enable navigation
```

---

## 🎯 User Experience

### Emotional Journey:
1. **Curiosity** - Pertanyaan unik
2. **Engagement** - Jawab satu per satu
3. **Surprise** - Nama tersusun!
4. **Joy** - "Calon masa depan kamu"
5. **Playfulness** - Tombol jahil
6. **Satisfaction** - Berhasil klik!

### Timing:
- Quiz: ~2-3 menit
- Name reveal: 5 detik
- Subtitle display: 3 detik
- Playful button: 4-5 clicks
- **Total**: ~3-4 menit

---

## ✨ Highlights

- 🎯 **Custom questions** yang personal
- 💕 **Name reveal** dengan animasi elegan
- 😏 **Playful button** yang fun
- 🎭 **Smooth transitions** di setiap step
- 💖 **Emotional message** yang sweet
- 🎪 **Interactive** dan engaging

---

## 🔧 Customization

### Mengubah Nama:
Edit di `showNameReveal()`:
```javascript
const name = 'FIJAN'; // Ubah sesuai keinginan
```

### Mengubah Pesan Jahil:
Edit array `messages`:
```javascript
const messages = [
    'Pesan 1',
    'Pesan 2',
    'Pesan 3',
    'Pesan 4'
];
```

### Mengubah Jumlah Click:
Edit kondisi:
```javascript
if (playfulClickCount < 4) { // Ubah angka 4
```

---

**Quiz page sekarang lebih personal, fun, dan memorable!** 🎉💕
