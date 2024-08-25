let sorular = [];
let puan = 0;

function showPanel(panelId) {
    const panels = document.querySelectorAll('.panel');
    panels.forEach(panel => {
        panel.style.display = 'none';
    });
    document.getElementById(panelId).style.display = 'block';

    if (panelId === 'soruCozme') {
        document.getElementById('rastgeleSoruButonu').style.display = 'block';
    }
}

function soruEkle() {
    const soruMetni = document.getElementById('soruMetni').value;
    const secenekA = document.getElementById('secenekA').value;
    const secenekB = document.getElementById('secenekB').value;
    const secenekC = document.getElementById('secenekC').value;
    const secenekD = document.getElementById('secenekD').value;
    const dogruCevap = document.getElementById('dogruCevap').value.toUpperCase();
    const zorlukDerecesi = document.getElementById('zorlukDerecesi').value;
    if (soruMetni && secenekA && secenekB && secenekC && secenekD && dogruCevap && zorlukDerecesi) {
        sorular.push({ 
            metin: soruMetni, 
            secenekler: { A: secenekA, B: secenekB, C: secenekC, D: secenekD }, 
            dogruCevap: dogruCevap,
            zorluk: zorlukDerecesi
        });
        document.getElementById('soruMetni').value = '';
        document.getElementById('secenekA').value = '';
        document.getElementById('secenekB').value = '';
        document.getElementById('secenekC').value = '';
        document.getElementById('secenekD').value = '';
        document.getElementById('dogruCevap').value = '';
        document.getElementById('zorlukDerecesi').value = '1';
        mesajGoster('Soru eklendi!');
        soruListesiniGuncelle();
    } else {
        mesajGoster('Lütfen tüm alanları doldurun!');
    }
}

function soruSil() {
    const silinecekSoru = document.getElementById('silinecekSoru').value;
    sorular = sorular.filter(soru => soru.metin !== silinecekSoru);
    document.getElementById('silinecekSoru').value = '';
    mesajGoster('Soru silindi!');
    soruListesiniGuncelle();
}

function soruDuzenle() {
    const duzenlenecekSoru = document.getElementById('duzenlenecekSoru').value;
    const yeniSoruMetni = document.getElementById('yeniSoruMetni').value;
    const yeniSecenekA = document.getElementById('yeniSecenekA').value;
    const yeniSecenekB = document.getElementById('yeniSecenekB').value;
    const yeniSecenekC = document.getElementById('yeniSecenekC').value;
    const yeniSecenekD = document.getElementById('yeniSecenekD').value;
    const yeniDogruCevap = document.getElementById('yeniDogruCevap').value.toUpperCase();
    const yeniZorlukDerecesi = document.getElementById('yeniZorlukDerecesi').value;
    const soru = sorular.find(soru => soru.metin === duzenlenecekSoru);
    if (soru) {
        soru.metin = yeniSoruMetni;
        soru.secenekler = { A: yeniSecenekA, B: yeniSecenekB, C: yeniSecenekC, D: yeniSecenekD };
        soru.dogruCevap = yeniDogruCevap;
        soru.zorluk = yeniZorlukDerecesi;
        document.getElementById('duzenlenecekSoru').value = '';
        document.getElementById('yeniSoruMetni').value = '';
        document.getElementById('yeniSecenekA').value = '';
        document.getElementById('yeniSecenekB').value = '';
        document.getElementById('yeniSecenekC').value = '';
        document.getElementById('yeniSecenekD').value = '';
        document.getElementById('yeniDogruCevap').value = '';
        document.getElementById('yeniZorlukDerecesi').value = '1';
        mesajGoster('Soru düzenlendi!');
        soruListesiniGuncelle();
    } else {
        mesajGoster('Soru bulunamadı!');
    }
}

function soruAra() {
    const aranacakSoru = document.getElementById('aranacakSoru').value;
    const soru = sorular.find(soru => soru.metin === aranacakSoru);
    if (soru) {
        mesajGoster(`Soru: ${soru.metin}, Seçenekler: A) ${soru.secenekler.A}, B) ${soru.secenekler.B}, C) ${soru.secenekler.C}, D) ${soru.secenekler.D}, Doğru Cevap: ${soru.dogruCevap}, Zorluk: ${soru.zorluk}`);
    } else {
        mesajGoster('Soru bulunamadı!');
    }
}

function rastgeleSoruGetir() {
    const rastgeleSoru = sorular[Math.floor(Math.random() * sorular.length)];
    document.getElementById('rastgeleSoru').innerHTML = `
        <p>${rastgeleSoru.metin}</p>
        <p>A) ${rastgeleSoru.secenekler.A}</p>
        <p>B) ${rastgeleSoru.secenekler.B}</p>
        <p>C) ${rastgeleSoru.secenekler.C}</p>
        <p>D) ${rastgeleSoru.secenekler.D}</p>
    `;
    document.getElementById('rastgeleSoru').dataset.dogruCevap = rastgeleSoru.dogruCevap;
    document.getElementById('rastgeleSoru').dataset.zorluk = rastgeleSoru.zorluk;
}

function cevabiKontrolEt() {
    const cevap = document.getElementById('cevap').value.toUpperCase();
    const dogruCevap = document.getElementById('rastgeleSoru').dataset.dogruCevap;
    const zorluk = document.getElementById('rastgeleSoru').dataset.zorluk;
    if (cevap === dogruCevap) {
        puan += parseInt(zorluk) * 10;
        document.getElementById('puan').innerText = 'Puan: ' + puan;
    } else {
        mesajGoster('Yanlış cevap!');
    }
    document.getElementById('cevap').value = '';
}

function soruListesiniGuncelle() {
    const soruListesiUl = document.getElementById('soruListesiUl');
    soruListesiUl.innerHTML = '';
    sorular.forEach(soru => {
        const li = document.createElement('li');
        li.innerText = `Soru: ${soru.metin}, Seçenekler: A) ${soru.secenekler.A}, B) ${soru.secenekler.B}, C) ${soru.secenekler.C}, D) ${soru.secenekler.D}, Doğru Cevap: ${soru.dogruCevap}, Zorluk: ${soru.zorluk}`;
        soruListesiUl.appendChild(li);
    });
}

function mesajGoster(mesaj) {
    const mesajDiv = document.getElementById('mesaj');
    mesajDiv.innerText = mesaj;
    mesajDiv.style.display = 'block';
    setTimeout(() => {
        mesajDiv.style.display = 'none';
    }, 3000);
}