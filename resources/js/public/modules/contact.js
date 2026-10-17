document.addEventListener('DOMContentLoaded', () => {
    /* 
    |──────────────────────────────────────────────────────────────────────────────────
    |   Custom Dropdown Keperluan
    |──────────────────────────────────────────────────────────────────────────────────
    */
    const dropdown = document.getElementById('keperluan-dropdown');

    if (dropdown) {
        const trigger  = document.getElementById('keperluan-trigger');
        const options  = document.getElementById('keperluan-options');
        const display  = document.getElementById('keperluan-display');
        const hidden   = document.getElementById('keperluan-value');
        const items    = document.querySelectorAll('.keperluan-option');

        const getIcon = () => trigger.querySelector('svg');

        const openDropdown = () => {
            options.classList.remove('hidden');
            trigger.setAttribute('aria-expanded', 'true');
            trigger.classList.add('border-var10');
            trigger.classList.remove('border-var5');
            getIcon()?.classList.add('rotate-180');
        };

        const closeDropdown = () => {
            options.classList.add('hidden');
            trigger.setAttribute('aria-expanded', 'false');
            trigger.classList.remove('border-var10');
            trigger.classList.add('border-var5');
            getIcon()?.classList.remove('rotate-180');
        };

        trigger.addEventListener('click', () => {
            options.classList.contains('hidden') ? openDropdown() : closeDropdown();
        });

        items.forEach(item => {
            item.addEventListener('click', () => {
                items.forEach(i => i.setAttribute('aria-selected', 'false'));
                item.setAttribute('aria-selected', 'true');

                hidden.value          = item.dataset.value;
                display.textContent   = item.textContent.trim();
                display.classList.remove('text-var6');

                trigger.classList.remove('border-var10');
                trigger.classList.add('border-var5');
                const errorDiv = trigger.parentElement?.parentElement?.querySelector('.error-message');
                if (errorDiv) {
                    errorDiv.classList.add('hidden');
                    errorDiv.textContent = '';
                }

                closeDropdown();
            });
        });

        document.addEventListener('click', (e) => {
            if (!dropdown.contains(e.target)) closeDropdown();
        });
    }

    /* 
    |──────────────────────────────────────────────────────────────────────────────────
    |   Form Validation & Submission
    |──────────────────────────────────────────────────────────────────────────────────
    */
    const form             = document.getElementById('contactForm');
    const submitBtn        = document.getElementById('submitBtn');
    const btnText          = document.getElementById('btnText');
    const btnIcon          = document.getElementById('btnIcon');
    const notificationArea = document.getElementById('notificationArea');

    const requiredFields = {
        nama:      { element: document.getElementById('nama'),           errorMsg: 'Nama lengkap wajib diisi.' },
        whatsapp:  { element: document.getElementById('whatsapp'),       errorMsg: 'Nomor WhatsApp wajib diisi.' },
        email:     { element: document.getElementById('email'),          errorMsg: 'Email wajib diisi.', validate: () => {
            const val = document.getElementById('email').value;
            return val && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(val) ? 'Format email tidak valid.' : null;
        }},
        keperluan: { element: document.getElementById('keperluan-value'), errorMsg: 'Silakan pilih keperluan.' },
        pesan:     { element: document.getElementById('pesan'),           errorMsg: 'Pesan wajib diisi.', validate: () => {
            const val = document.getElementById('pesan').value;
            return val && val.length < 10 ? 'Pesan minimal 10 karakter.' : null;
        }},
    };

    function clearAllErrors() {
        document.querySelectorAll('.error-message').forEach(el => {
            el.classList.add('hidden');
            el.textContent = '';
        });
        document.querySelectorAll('input, textarea, #keperluan-trigger').forEach(el => {
            el.classList.remove('border-var10');
            el.classList.add('border-var5');
        });
    }

    function showError(fieldId, message) {
        let element, errorDiv;

        if (fieldId === 'keperluan') {
            element  = document.getElementById('keperluan-trigger');
            errorDiv = element?.parentElement?.parentElement?.querySelector('.error-message');
        } else {
            element  = document.getElementById(fieldId);
            errorDiv = element?.parentElement?.querySelector('.error-message');
        }

        if (element)  { element.classList.remove('border-var5'); element.classList.add('border-var10'); }
        if (errorDiv) { errorDiv.textContent = message; errorDiv.classList.remove('hidden'); }
    }

    function validateForm() {
        clearAllErrors();
        let isValid = true;

        if (!requiredFields.nama.element.value.trim())     { showError('nama', requiredFields.nama.errorMsg);           isValid = false; }
        if (!requiredFields.whatsapp.element.value.trim()) { showError('whatsapp', requiredFields.whatsapp.errorMsg);   isValid = false; }

        const emailVal = requiredFields.email.element.value.trim();
        if (!emailVal) {
            showError('email', requiredFields.email.errorMsg); isValid = false;
        } else {
            const emailErr = requiredFields.email.validate?.();
            if (emailErr) { showError('email', emailErr); isValid = false; }
        }

        if (!requiredFields.keperluan.element.value) { showError('keperluan', requiredFields.keperluan.errorMsg); isValid = false; }

        const pesanVal = requiredFields.pesan.element.value.trim();
        if (!pesanVal) {
            showError('pesan', requiredFields.pesan.errorMsg); isValid = false;
        } else {
            const pesanErr = requiredFields.pesan.validate?.();
            if (pesanErr) { showError('pesan', pesanErr); isValid = false; }
        }

        return isValid;
    }

    if (form) {
        form.addEventListener('submit', async (e) => {
            e.preventDefault();

            notificationArea.innerHTML = '';
            notificationArea.classList.add('hidden');

            if (!validateForm()) {
                document.querySelector('.border-var10')?.scrollIntoView({ behavior: 'smooth', block: 'center' });
                return;
            }

            const originalText = btnText.textContent;

            // Loading state — sembunyikan icon, ganti teks
            btnText.textContent = 'Memproses...';
            btnIcon.classList.add('hidden');
            submitBtn.disabled = true;
            submitBtn.classList.add('bg-var11', 'cursor-progress');
            submitBtn.classList.remove('bg-var10', 'hover:bg-var11');

            try {
                const response = await fetch(form.action, {
                    method:  'POST',
                    body:    new FormData(form),
                    headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' },
                });

                const result = await response.json();

                if (response.ok && result.success) {
                    showNotification('success', result.message || 'Pesan Anda berhasil dikirim! Kami akan menghubungi Anda secepatnya.');
                    form.reset();

                    // Reset dropdown display
                    if (dropdown) {
                        const disp    = document.getElementById('keperluan-display');
                        const hid     = document.getElementById('keperluan-value');
                        const trigger = document.getElementById('keperluan-trigger');
                        if (disp)    { disp.textContent = 'Silakan pilih keperluan'; disp.classList.add('text-var6'); }
                        if (hid)     { hid.value = ''; }
                        if (trigger) { trigger.classList.remove('border-var10'); trigger.classList.add('border-var5'); }
                    }

                    clearAllErrors();
                } else {
                    if (result.errors) {
                        showNotification('error', 'Mohon periksa kembali form Anda.');
                        Object.entries(result.errors).forEach(([field, messages]) => showError(field, messages[0]));
                    } else {
                        showNotification('error', result.message || 'Terjadi kesalahan. Silakan coba lagi.');
                    }
                }
            } catch (error) {
                console.error('Error:', error);
                showNotification('error', 'Terjadi kesalahan: ' + error.message);
            } finally {
                btnText.textContent = originalText;
                btnIcon.classList.remove('hidden');
                submitBtn.disabled = false;
                submitBtn.classList.remove('bg-var11', 'cursor-progress');
                submitBtn.classList.add('bg-var10', 'hover:bg-var11');
            }
        });
    }

    function showNotification(type, message) {
        notificationArea.classList.remove('hidden');
        notificationArea.innerHTML = `
            <div class="mt-7 px-5 py-3.5 rounded-xl text-base font-medium flex items-start gap-3 ${
                type === 'success'
                    ? 'bg-green-100 text-green-800 border-l-4 border-green-500'
                    : 'bg-red-100 text-red-800 border-l-4 border-red-500'
            }" role="alert" aria-live="polite">
                <i data-lucide="${type === 'success' ? 'check-circle' : 'alert-circle'}" class="w-5 h-5 mt-0.5 shrink-0"></i>
                <div class="flex-1">${message}</div>
                <button type="button" class="close-notification text-current opacity-60 hover:opacity-100" aria-label="Tutup">
                    <i data-lucide="x" class="w-4 h-4"></i>
                </button>
            </div>
        `;

        const { createIcons, icons } = window.lucide;
        createIcons({ icons });

        notificationArea.querySelector('.close-notification')?.addEventListener('click', () => {
            notificationArea.classList.add('hidden');
        });

        if (type === 'success') setTimeout(() => notificationArea.classList.add('hidden'), 5000);

        notificationArea.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }
});