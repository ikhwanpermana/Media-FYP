// Script Otomatis Kolektor Berita Viral
const SUPABASE_URL = "https://id_proyek_anda.supabase.co"; 
const SUPABASE_KEY = "sb_publishable_anda..."; 

async function ambilBeritaViral() {
    console.log("Memulai pencarian berita fyp...");
    try {
        // Mengambil tren berita terbaru dari RSS Feed Google News Indonesia
        const responRSS = await fetch("https://rss2json.com");
        const dataRSS = await responRSS.json();
        
        if (!dataRSS.items) return;

        // Ambil 5 berita paling atas
        const daftarBerita = dataRSS.items.slice(0, 5);

        for (let berita of daftarBerita) {
            const dataBerita = {
                title: berita.title,
                category: "Hiburan", // Kategori default otomatis
                content: `Berita viral terbaru hari ini: ${berita.title}. Baca selengkapnya langsung melalui sumber terpercaya.`,
                views: Math.floor(Math.random() * 50) + 10 // Pancingan klik awal acak
            };

            // Simpan otomatis ke Cloud Database Supabase
            await fetch(`${SUPABASE_URL}/rest/v1/articles`, {
                method: 'POST',
                headers: {
                    "apikey": SUPABASE_KEY,
                    "Authorization": `Bearer ${SUPABASE_KEY}`,
                    "Content-Type": "application/json",
                    "Prefer": "return=minimal"
                },
                body: JSON.stringify(dataBerita)
            });
            console.log(`Berhasil menginput: ${berita.title}`);
        }
    } catch (error) {
        console.error("Gagal mengoperasikan bot:", error);
    }
}

ambilBeritaViral();
