<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Akun</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
      tailwind.config = {
        theme: {
          extend: {
            colors: {
              'primary': '#07689F',
              'secondary': '#A2D5F2',
              'base': '#FAFAFA',
              'accent': '#FF7E67',
            }
          }
        }
      }
    </script>    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>
<body class="bg-base font-sans">

    <div class="flex items-center justify-center min-h-screen">
        <div class="relative flex flex-col m-6 space-y-8 bg-white shadow-2xl rounded-2xl md:flex-row md:space-y-0">
            
            <div class="relative flex flex-col justify-center p-8 text-white bg-primary rounded-2xl md:w-[450px]">
                <div class="z-10">
                    <h1 class="text-4xl font-bold mb-3 tracking-wide">Selamat Datang!</h1>
                    <p class="font-light max-w-sm">
                        Sistem Informasi Bimbingan Tugas Akhir. Daftar untuk memulai proses bimbingan Anda.
                    </p>
                </div>
                <div class="absolute top-4 -right-4 w-28 h-28 bg-secondary rounded-full mix-blend-screen opacity-50"></div>
                <div class="absolute -bottom-4 -left-4 w-32 h-32 bg-accent rounded-full mix-blend-screen opacity-50"></div>
            </div>

            <div class="flex flex-col justify-center p-8 md:p-14">
                <span class="mb-3 text-4xl font-bold text-primary">Buat Akun</span>
                <span class="font-light text-gray-500 mb-8">
                    Silakan isi data diri Anda untuk melanjutkan.
                </span>
                
                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <div class="py-4">
                        <label for="name" class="mb-2 text-md font-medium text-gray-700">Nama Lengkap</label>
                        <input 
                            type="text" 
                            id="name"
                            name="name"
                            required
                            class="w-full p-3 border border-secondary rounded-lg placeholder:font-light placeholder:text-gray-400 focus:outline-none focus:ring-1 focus:ring-primary focus:border-primary"
                            placeholder="Contoh: Budi Sanjaya"
                        >
                    </div>

                    <div class="py-4">
                        <label for="email" class="mb-2 text-md font-medium text-gray-700">Alamat Email</label>
                        <input 
                            type="email" 
                            id="email"
                            name="email"
                            required
                            class="w-full p-3 border border-secondary rounded-lg placeholder:font-light placeholder:text-gray-400 focus:outline-none focus:ring-1 focus:ring-primary focus:border-primary"
                            placeholder="email@contoh.com"
                        >
                    </div>

                    <div class="py-4">
                        <label for="password" class="mb-2 text-md font-medium text-gray-700">Password</label>
                        <input 
                            type="password" 
                            id="password"
                            name="password"
                            required
                            class="w-full p-3 border border-secondary rounded-lg placeholder:font-light placeholder:text-gray-400 focus:outline-none focus:ring-1 focus:ring-primary focus:border-primary"
                        >
                    </div>

                    <div class="py-4">
                        <label for="password_confirmation" class="mb-2 text-md font-medium text-gray-700">Konfirmasi Password</label>
                        <input 
                            type="password" 
                            id="password_confirmation"
                            name="password_confirmation"
                            required
                            class="w-full p-3 border border-secondary rounded-lg placeholder:font-light placeholder:text-gray-400 focus:outline-none focus:ring-1 focus:ring-primary focus:border-primary"
                        >
                    </div>

                    <button 
                        type="submit"
                        class="w-full bg-accent text-white p-3 mt-4 rounded-lg font-bold text-lg hover:bg-opacity-90 transition-opacity duration-200"
                    >
                        Daftar Sekarang
                    </button>
                </form>
                
                <div class="text-center mt-6">
                    <p class="text-sm font-light text-gray-500">
                        Sudah punya akun? 
                        <a href="{{ route('login') }}" class="font-medium text-primary hover:underline">Masuk di sini</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>