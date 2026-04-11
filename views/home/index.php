<!DOCTYPE html>
<html lang="vi" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CloudJourney - Khám phá hành trình tuyệt vời của bạn</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .tour-card { transition: transform 0.35s ease, box-shadow 0.35s ease; }
        .tour-card:hover { transform: translateY(-10px); }
        .hero-glow { box-shadow: 0 30px 90px rgba(15, 23, 42, 0.18); }
    </style>
</head>
<body class="bg-[#f9faff] text-slate-900">
    <nav class="fixed inset-x-0 top-0 z-50 bg-white/90 backdrop-blur-xl border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-6 md:px-8 h-24 flex items-center justify-between">
            <div class="flex items-center gap-8">
                <a href="?url=home" class="text-2xl font-extrabold text-slate-900">CloudJourney</a>
                <div class="hidden lg:flex items-center gap-6 text-sm font-medium text-slate-600">
                    <a href="#destinations" class="hover:text-blue-700 transition">Khám phá</a>
                    <a href="#features" class="hover:text-blue-700 transition">Lý do chọn</a>
                    <a href="#testimonials" class="hover:text-blue-700 transition">Đánh giá</a>
                    <a href="?url=contact" class="hover:text-blue-700 transition">Liên hệ</a>
                </div>
            </div>
            <div class="flex items-center gap-4">
                <button class="rounded-full border border-slate-300 px-4 py-2 text-sm text-slate-600 hover:bg-slate-100 transition">VN/EN</button>
                <a href="?url=login" class="hidden md:inline-flex items-center justify-center rounded-full bg-blue-700 px-6 py-3 text-sm font-semibold text-white hover:bg-blue-800 transition">Đăng nhập</a>
            </div>
        </div>
    </nav>

    <main class="pt-24">
        <section class="relative overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-br from-slate-950/30 via-slate-950/10 to-slate-950/50"></div>
            <img src="uploads/picture1.jfif" alt="Bãi biển" class="absolute inset-0 w-full h-full object-cover opacity-90">
            <div class="relative max-w-7xl mx-auto px-6 md:px-8 py-28">
                <div class="max-w-3xl text-center mx-auto text-white">
                    <p class="inline-flex items-center gap-2 rounded-full bg-white/15 px-4 py-2 text-sm font-medium tracking-wide text-white/90 shadow-lg shadow-slate-950/20">CloudJourney • Khám phá hành trình tuyệt vời</p>
                    <h1 class="mt-8 text-4xl md:text-6xl font-extrabold leading-tight">Khám phá hành trình tuyệt vời của bạn</h1>
                    <p class="mt-6 text-base md:text-lg text-white/85">Hành trình trọn vẹn từ khởi hành đến điểm đến, thiết kế riêng cho trải nghiệm nghỉ dưỡng của bạn.</p>
                </div>

                <div class="mt-12 bg-white/95 backdrop-blur-xl rounded-[2rem] border border-white/70 shadow-2xl hero-glow p-6 md:p-8 max-w-5xl mx-auto">
                    <div class="grid gap-4 md:grid-cols-[1.5fr_1fr] lg:grid-cols-[1.7fr_1fr_0.9fr] items-center">
                        <div class="space-y-4">
                            <div class="rounded-3xl border border-slate-200 bg-slate-50 p-4 flex items-center gap-4">
                                <span class="inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-700 text-white">📍</span>
                                <div>
                                    <p class="text-xs uppercase tracking-[0.2em] text-slate-500">Điểm đến</p>
                                    <input type="text" placeholder="Bạn muốn đi đâu?" class="w-full bg-transparent text-slate-900 placeholder:text-slate-400 outline-none" />
                                </div>
                            </div>
                            <div class="rounded-3xl border border-slate-200 bg-slate-50 p-4 flex items-center gap-4">
                                <span class="inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-700 text-white">📅</span>
                                <div>
                                    <p class="text-xs uppercase tracking-[0.2em] text-slate-500">Ngày đi</p>
                                    <input type="date" class="w-full bg-transparent text-slate-900 outline-none" />
                                </div>
                            </div>
                        </div>
                        <div class="rounded-3xl border border-slate-200 bg-slate-50 p-4 flex flex-col justify-between gap-4">
                            <div class="flex items-center gap-4">
                                <span class="inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-700 text-white">👥</span>
                                <div>
                                    <p class="text-xs uppercase tracking-[0.2em] text-slate-500">Hành khách</p>
                                    <input type="text" placeholder="2 người lớn" class="w-full bg-transparent text-slate-900 placeholder:text-slate-400 outline-none" />
                                </div>
                            </div>
                            <button class="w-full rounded-3xl bg-orange-500 px-6 py-4 text-base font-semibold text-white shadow-xl shadow-orange-400/30 hover:bg-orange-600 transition">Tìm kiếm</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="destinations" class="max-w-7xl mx-auto px-6 md:px-8 py-24">
            <div class="text-center mb-14">
                <p class="text-sm uppercase tracking-[0.3em] text-blue-700 font-semibold">Chuyến đi nổi bật</p>
                <h2 class="mt-4 text-4xl md:text-5xl font-extrabold text-slate-900">Chuyến đi kết hợp tiện nghi và cảnh đẹp</h2>
                <p class="mt-4 text-slate-600 max-w-2xl mx-auto">Những hành trình được chọn lọc dành cho bạn để khám phá vẻ đẹp thế giới cùng dịch vụ tận tâm.</p>
            </div>

            <div class="grid gap-8 md:grid-cols-3">
                <?php
                $sample_tours = [
                    ['name' => 'Vịnh Hạ Long kỳ thú', 'subtitle' => '3 Ngày 2 Đêm', 'img' => 'picture2.jfif', 'price' => '3,500,000đ', 'tag' => 'Hot'],
                    ['name' => 'Khám phá Đảo Bali', 'subtitle' => '5 Ngày 4 Đêm', 'img' => 'picture3.jfif', 'price' => '12,200,000đ', 'tag' => 'Giảm giá'],
                    ['name' => 'Mùa Hoa Anh Đào Nhật Bản', 'subtitle' => '6 Ngày 5 Đêm', 'img' => 'picture4.jfif', 'price' => '25,900,000đ', 'tag' => 'Best seller'],
                ];
                foreach ($sample_tours as $tour):
                ?>
                <article class="tour-card overflow-hidden rounded-[2rem] bg-white shadow-[0_24px_90px_rgba(15,23,42,0.08)] border border-slate-200">
                    <div class="relative h-72 overflow-hidden">
                        <img src="uploads/<?php echo $tour['img']; ?>" alt="<?php echo $tour['name']; ?>" class="h-full w-full object-cover transition duration-500 hover:scale-105" />
                        <span class="absolute left-4 top-4 rounded-full bg-white/90 px-4 py-2 text-xs font-semibold text-slate-900 shadow-sm"><?php echo $tour['tag']; ?></span>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center justify-between gap-4 mb-4">
                            <div>
                                <h3 class="text-xl font-semibold text-slate-900"><?php echo $tour['name']; ?></h3>
                                <p class="mt-2 text-sm text-slate-500"><?php echo $tour['subtitle']; ?></p>
                            </div>
                            <div class="text-right">
                                <p class="text-2xl font-extrabold text-blue-700"><?php echo $tour['price']; ?></p>
                            </div>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="inline-flex items-center gap-2 rounded-full bg-slate-100 px-4 py-2 text-sm font-medium text-slate-600">⭐ 4.9</span>
                            <button class="rounded-full bg-orange-500 px-5 py-3 text-sm font-semibold text-white hover:bg-orange-600 transition">Đặt ngay</button>
                        </div>
                    </div>
                </article>
                <?php endforeach; ?>
            </div>
        </section>

        <section id="features" class="bg-slate-50 py-24">
            <div class="max-w-7xl mx-auto px-6 md:px-8">
                <div class="text-center mb-14">
                    <p class="text-sm uppercase tracking-[0.3em] text-blue-700 font-semibold">Tại sao chọn CloudJourney?</p>
                    <h2 class="mt-4 text-4xl md:text-5xl font-extrabold text-slate-900">Dịch vụ trọn gói, an toàn và đáng tin cậy</h2>
                    <p class="mt-4 text-slate-600 max-w-2xl mx-auto">Chúng tôi mang đến sự an tâm và những trải nghiệm độc đáo nhất cho mọi hành trình của bạn.</p>
                </div>

                <div class="grid gap-6 md:grid-cols-4">
                    <div class="rounded-[2rem] bg-white p-8 shadow-sm border border-slate-200">
                        <div class="inline-flex h-14 w-14 items-center justify-center rounded-3xl bg-blue-100 text-blue-700 text-xl">✔</div>
                        <h3 class="mt-6 text-xl font-semibold text-slate-900">An toàn tuyệt đối</h3>
                        <p class="mt-3 text-sm text-slate-600">Hỗ trợ khách hàng 24/7 và bảo hiểm hành trình đầy đủ.</p>
                    </div>
                    <div class="rounded-[2rem] bg-white p-8 shadow-sm border border-slate-200">
                        <div class="inline-flex h-14 w-14 items-center justify-center rounded-3xl bg-blue-100 text-blue-700 text-xl">💰</div>
                        <h3 class="mt-6 text-xl font-semibold text-slate-900">Giá cả cạnh tranh</h3>
                        <p class="mt-3 text-sm text-slate-600">Ưu đãi tốt nhất từ nhà cung cấp và nhiều lựa chọn phù hợp với ngân sách.</p>
                    </div>
                    <div class="rounded-[2rem] bg-white p-8 shadow-sm border border-slate-200">
                        <div class="inline-flex h-14 w-14 items-center justify-center rounded-3xl bg-blue-100 text-blue-700 text-xl">🗺</div>
                        <h3 class="mt-6 text-xl font-semibold text-slate-900">Lộ trình đa dạng</h3>
                        <p class="mt-3 text-sm text-slate-600">Tour đặc sắc cập nhật hàng tuần cho mọi phong cách du lịch.</p>
                    </div>
                    <div class="rounded-[2rem] bg-white p-8 shadow-sm border border-slate-200">
                        <div class="inline-flex h-14 w-14 items-center justify-center rounded-3xl bg-blue-100 text-blue-700 text-xl">🤝</div>
                        <h3 class="mt-6 text-xl font-semibold text-slate-900">Dịch vụ tận tâm</h3>
                        <p class="mt-3 text-sm text-slate-600">Đội ngũ tư vấn giàu kinh nghiệm phục vụ chu đáo từng khách hàng.</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="testimonials" class="max-w-7xl mx-auto px-6 md:px-8 py-24">
            <div class="text-center mb-14">
                <p class="text-sm uppercase tracking-[0.3em] text-blue-700 font-semibold">Khách hàng nói gì về chúng tôi</p>
                <h2 class="mt-4 text-4xl md:text-5xl font-extrabold text-slate-900">Trải nghiệm của khách hàng</h2>
            </div>

            <div class="grid gap-8 lg:grid-cols-3">
                <div class="rounded-[2rem] bg-white p-8 shadow-[0_20px_60px_rgba(15,23,42,0.08)] border border-slate-200">
                    <p class="text-slate-600">“Mọi chuyến đi đều được tổ chức vô cùng chuyên nghiệp. Tôi hoàn toàn yên tâm khi đặt tour đến khắp nơi trên thế giới.”</p>
                    <div class="mt-8">
                        <p class="font-semibold text-slate-900">Minh Anh</p>
                        <p class="text-sm text-slate-500">Giám đốc Sáng tạo</p>
                    </div>
                </div>
                <div class="rounded-[2rem] bg-white p-8 shadow-[0_20px_60px_rgba(15,23,42,0.08)] border border-slate-200">
                    <p class="text-slate-600">“Dịch vụ xuất sắc và giá cả hợp lý. Tour Bali thực sự là một trải nghiệm không thể quên.”</p>
                    <div class="mt-8">
                        <p class="font-semibold text-slate-900">Hoàng Nam</p>
                        <p class="text-sm text-slate-500">Nhà báo du lịch</p>
                    </div>
                </div>
                <div class="rounded-[2rem] bg-white p-8 shadow-[0_20px_60px_rgba(15,23,42,0.08)] border border-slate-200">
                    <p class="text-slate-600">“Hỗ trợ nhiệt tình, tư vấn tận tâm. Chuyến đi Nhật Bản của tôi hoàn toàn suôn sẻ và rất đáng nhớ.”</p>
                    <div class="mt-8">
                        <p class="font-semibold text-slate-900">Lan Phương</p>
                        <p class="text-sm text-slate-500">Chuyên viên sự kiện</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="bg-blue-900 text-white py-24">
            <div class="max-w-6xl mx-auto px-6 md:px-8 text-center">
                <h2 class="text-4xl md:text-5xl font-extrabold">Đăng ký để nhận ưu đãi bí mật</h2>
                <p class="mt-4 text-slate-200 max-w-2xl mx-auto">Gia nhập cộng đồng hơn 50,000 người yêu du lịch và nhận những deal hấp dẫn nhất trực tiếp vào email của bạn.</p>
                <div class="mt-10 flex flex-col gap-4 sm:flex-row items-center justify-center">
                    <input type="email" placeholder="Địa chỉ email của bạn" class="w-full max-w-xl rounded-full border border-white/30 bg-white/10 px-6 py-4 text-white placeholder:text-slate-200 outline-none focus:border-white focus:bg-white/15" />
                    <button class="rounded-full bg-orange-500 px-8 py-4 text-sm font-semibold uppercase tracking-[0.15em] text-white hover:bg-orange-400 transition">Đăng ký ngay</button>
                </div>
            </div>
        </section>
    </main>

    <footer class="bg-slate-950 text-slate-300 py-14">
        <div class="max-w-7xl mx-auto px-6 md:px-8 grid gap-10 lg:grid-cols-4">
            <div>
                <h3 class="text-xl font-semibold text-white">CloudJourney</h3>
                <p class="mt-4 text-sm text-slate-400">Khám phá thế giới theo cách riêng của bạn cùng CloudJourney. Hành trình trọn vẹn, kết nối toàn cầu.</p>
            </div>
            <div>
                <h4 class="font-semibold text-white mb-4">Công ty</h4>
                <ul class="space-y-3 text-sm text-slate-400">
                    <li>Về chúng tôi</li>
                    <li>Tuyển dụng</li>
                    <li>Tin tức</li>
                </ul>
            </div>
            <div>
                <h4 class="font-semibold text-white mb-4">Hỗ trợ</h4>
                <ul class="space-y-3 text-sm text-slate-400">
                    <li>Trung tâm hỗ trợ</li>
                    <li>Câu hỏi thường gặp</li>
                    <li>Chính sách hoàn tiền</li>
                </ul>
            </div>
            <div>
                <h4 class="font-semibold text-white mb-4">Pháp lý</h4>
                <ul class="space-y-3 text-sm text-slate-400">
                    <li>Chính sách bảo mật</li>
                    <li>Điều khoản dịch vụ</li>
                </ul>
            </div>
        </div>
        <div class="mt-10 border-t border-slate-800 pt-6 text-center text-sm text-slate-500">© 2026 CloudJourney. Tất cả quyền được bảo lưu.</div>
    </footer>
</body>
</html>
