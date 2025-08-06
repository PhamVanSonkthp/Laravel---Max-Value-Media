<?php

namespace Database\Seeders;

use App\Models\Formatter;
use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreateSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::firstOrCreate([
            'point' => 1,
            'amount' => 1,
            'bank_name' => "Vietcombank",
            'bank_number' => "0031000332320",
            'phone_contact' => "0378115213",
            'about_contact' => "Infinity",
            'address_contact' => "Hà Nội",
            'email_contact' => "ifnt@gmail.com",
            'privacy_policy_html' => "<h1>Chính sách riêng tư</h1>
    <p>Chính sách riêng tư này thông báo về lựa chọn và hành vi của chúng tôi về các thông tin cá nhân mà bạn cung
        cấp . Sử dụng ứng dụng này đồng nghĩa với việc bạn đã đồng ý với các chính sách liên quan đến thu thập dữ
        liệu và sử dụng thông tin cá nhân của bạn , quan trọng bạn phải hiểu và kiểm soát được nó.</p>
    <p>Khi bạn sử dụng ứng dụng đồng nghĩa là bạn đã chấp nhận các quy tắc và chính sách thu thập thông tin cá nhân
        và bạn đồng ý , chấp nhận cho chúng tôi thu thập , xử lý , sử dụng và lưu trữ thông tin cá nhân của bạn như
        mô tả trong chính sách.</p>
    <p>Bạn đồng ý đã đọc rõ và hiểu chính sách riêng tư này. Nếu không đồng ý với chính sách riêng tư này , bạn sẽ
        không được sử dụng ứng dụng của chúng tôi .</p>
    <p>Tổng Quát</p>
    <p>Chúng tôi thu thập những thông tin gì của bạn ?</p>
    <p>+) HỒ SƠ</p>
    <p>Chúng tôi thu thập thông tin về họ tên, số điện thoại, giới tính, ngày sinh, email, trường đại học, tôn giáo, địa chỉ, bình luận, hình ảnh và các hoạt
        động bạn đã làm trong ứng
        dụng của chúng tôi.</p>
    <p>
        Việc thu thập địa chỉ sẽ giúp chúng tôi tìm một nửa của bạn ở vị trí địa lý phù hợp với bạn nhất.
    </p>
    <p>
        Dữ liệu về trường đại học sẽ giúp chúng tôi ghép đôi bạn với người kia một cách phù hợp nhất có thể
    </p>
    <p>
        Dữ liệu về tôn giáo giúp chúng tôi lựa chọn những bạn phù hợp với tôn giáo của bạn
    </p>
    <p>+) TRẠNG THÁI ĐIỆN THOẠI</p>
    <p>Cho phép thu thập thông tin về việc tải và sử dụng ứng dụng. chúng tôi sẽ không thu thập những thông tin điện
        thoại như số IMEI và ID thiết bị.</p>
    <p>+) LƯU TRỮ</p>
    <p>Dùng cho những quyền liên quan đến việc truy cập và tải lên từ ổ cứng trong thiết bị của người dùng. Quyền
        này cho phép tải những tài nguyên liên quan đến ứng dụng và tải ảnh của người dùng từ thư viện ảnh trong
        thiết bị lên hồ sơ hoặc bạn bè.</p>
    <p>+) HÌNH ẢNH</p>
    <p>Dùng cho việc cập nhật hồ sơ, gửi hình ảnh</p>
    <p>+) INTERNET</p>
    <p>Cho phép ứng dụng kết nối đến nơi lưu trữ và xử lý dữ liệu cục bộ</p>
    <p>+) ID QUẢNG CÁO</p>
    <p>Dùng cho những quyền liên quan đến việc truy cập ID quảng cáo của Admob, Facebook, Unity . Quyền này cho phép
        thu thập dữ liệu tải xuống và nhằm nâng cao trải nghiệm người dùng và chiến lược quảng cáo ở thị trường.</p>
    <p>Chúng tôi sử dụng thông tin của bạn như thế nào ?</p>
    <p>- Chúng tôi sẽ dùng thông tin mà chúng tôi đã thu thập để vận hành và duy trì Dịch vụ và để phản hồi yêu cầu
        và thắc mắc của bạn.</p>
    <p>- Để giúp chúng tôi nâng cao nội dung và chức năng của Dịch vụ, nhằm hiểu hơn người dùng của chúng tôi và
        nhằm cải thiện Dịch vụ. Công ty và các Công ty Liên quan có thể dùng thông tin này để liên hệ bạn trong
        tương lai nhằm chào mời bạn những dịch vụ khác.</p>

    <p>Cách chúng tôi chia sẻ thông tin :</p>
    <p>+) Chúng tôi không bán thông tin của bạn. Chúng tôi xem những thông tin này là một phần quan trọng trong mối
        quan hệ của chúng tôi với bạn. Tuy nhiên, trong những hoàn cảnh cụ thể, chúng tôi có thể chia sẻ thông tin
        của bạn với các bên thứ ba nhất định.</p>
    <p>+) Chúng tôi sẽ không cho thuê hoặc bán những Thông tin Định danh Cá nhân của bạn cho người khác. Chúng tôi
        có thể lưu trữ thông tin cá nhân ở những địa điểm nằm ngoài sự kiểm soát trực tiếp của chúng tôi (ví dụ trên
        máy chủ hoặc cơ sở dữ liệu của nhà cung cấp lưu trữ). Bất kỳ Thông tin Định danh Cá nhân nào bạn chọn công
        khai trong Dịch vụ của chúng tôi, chẳng hạn như đăng bình luận trên những giao diện hiển thị công khai, thì
        người khác có thể thấy. Nếu bạn xóa thông tin mà bạn đã công khai trong Dịch vụ của chúng tôi, những bảo sao
        vẫn có thể thấy ở trong cache và các trang lưu trữ trong Dịch vụ của chúng tôi, hoặc những người dùng khác
        đã sao chép, lưu hoặc chụp lại thông tin đó.</p>
    <p>+) Chúng tôi có thể chia sẻ những Thông tin Không Định danh Cá nhân (như dữ liệu sử dụng nặc danh, trang
        đến/trang đi và URL, loại nền tảng, số lần bấm, v.v.) với những bên thứ ba quan tâm để giúp họ hiểu hình mẫu
        sử dụng cho những Dịch vụ nhất định và chia sẻ với những đối tác của chúng tôi. Thông tin Không Định danh Cá
        nhân có thể lưu trữ ở những địa điểm nằm ngoài sự kiểm soát trực tiếp của chúng tôi và được lưu trữ vĩnh
        viễn.</p>
    <p>+) Những trường hợp chúng tôi bắt buộc phải tiết lộ thông tin của bạn. Chúng tôi sẽ tiết lộ thông tin của bạn
        khi bắt buộc bởi luật pháp, nếu chiếu theo lệnh của tòa hoặc những thủ tục pháp lý khác hoặc nếu chúng tôi
        hợp lý cho rằng những hành động như vậy là cần thiết để tuân thủ luật pháp và những yêu cầu hành pháp hợp
        lý; tuân thủ các nghĩa vụ pháp lý; để bảo vệ sự an toàn cá nhân của Dịch vụ hoặc của công chúng; để thực thi
        những Điều khoản của chúng tôi hoặc để bảo vệ bảo mật hoặc sự toàn vẹn của Dịch vụ; và/hoặc bảo vệ các quyền
        và tài sản pháp lý của Công ty, Công ty Liên quan, người dùng hoặc những người khác.</p>
    <p>+) Những trường hợp khác chúng tôi có thể phải chia sẻ thông tin của bạn. Chuyển giao công việc. Chúng tôi
        và/hoặc những bên liên quan có thể mua bán/chuyển hướng/chuyển giao Công ty (bao gồm các cổ phần trong Công
        ty), hoặc bất kỳ kết hợp nào về sản phẩm, dịch vụ, tài sản và/hoặc hoạt động kinh doanh. Thông tin của bạn
        có thể nằm trong những mục được bán hoặc chuyển giao trong những giao dịch trên. Chúng tôi cũng có thể tiến
        hành hoạt động bán, sáp nhập, mua lại, phá sản, giải thể, tái cấu trúc, đóng cửa công ty và những giao dịch,
        thủ tục tương tự, trong đó, thông tin của bạn có thể là một phần trong tài sản có liên quan. Các đại lý, các
        tư vấn viên chuyên nghiệp và tương tự. Chúng tôi đôi khi tham gia với những công ty hoặc cá nhân khác để
        thực hiện những chức năng nhất định liên quan đến kinh doanh. Thông tin của bạn có thể được cung cấp cho họ
        vì những chức năng, bao gồm nhưng không giới hạn trong tư vấn chuyên nghiệp, bảo trì công nghệ và xử lý
        thanh toán. Mục đích phát triển. Các nhà phát triển sử dụng SDK hay API của chúng tôi sẽ được truy cập thông
        tin người dùng cuối của họ, bao gồm nội dung tin nhắn, siêu dữ liệu tin nhắn, siêu dữ liệu thoại và video,
        chỉ với mục đích cung cấp chức năng SDK/API trong ứng dụng và/hoặc dịch vụ của họ. Đánh giá. Chúng tôi có
        thể hiển thị một số đánh giá cá nhân của những khách hàng hài lòng ở trên Trang web, Phần mềm và Ứng dụng
        của chúng tôi. Khi bạn bằng lòng, chúng tôi sẽ đăng tải đánh giá kèm tên của bạn.</p>

    <p>Chúng tôi bảo mật thông tin của bạn như thế nào ?</p>
    <p>+) Chúng tôi quan tâm sâu sắc để bảo vệ sự riêng tư và dữ liệu của bạn. Chúng tôi luôn luôn thực hiện những
        biện pháp vật lý, kỹ thuật và quản lý hợp lý để bảo vệ thông tin thu thập được qua Dịch vụ không bị mất mát,
        dùng sai mục đích, truy cập, tiết lộ, sửa đổi hay phá hoại trái phép. Tuy nhiên, không có phương thức truyền
        dẫn nào qua Internet hoặc phương thức lưu trữ điện tử nào an toàn 100%. Do đó, bạn nên chú ý đặc biệt khi
        chọn gửi những thông tin nào đến chúng tôi qua e-mail. Vui lòng lưu ý điều này khi tiết lộ bất kỳ thông tin
        nào qua Internet.</p>
    <p>Chúng tôi lưu trữ thông tin của bạn như thế nào ?</p>
    <p>+) Chúng tôi lưu trữ và xử lý tại Việt nam , Hong Kong hoặc bất kỳ quốc gia nào mà Công ty liên quan.</p>
    <p>+) Chúng tôi sẽ lưu trữ thông tin của bạn trong thời gian tài khoản của bạn hoạt động hoặc cần sẵn sàng để
        cung cấp dịch vụ cho bạn. Chúng tôi sẽ lưu trữ và sử dụng thông tin của bạn sao cho phù hợp với các nghĩa vụ
        pháp lý của chúng tôi, giải quyết tranh cấp và thực thi hợp đồng.</p>
    <p>+) Để tiêu hủy thông tin cá nhân của bạn, chúng tôi có thể nặc danh hóa, xóa hoặc thực hiện những bước cần
        thiết khác. Thông tin có thể tồn tại trong các bản sao vì mục đích sao lưu và tiếp nối kinh doanh khác trong
        thời gian bổ sung.</p>

    <p>Trường hợp lộ thông tin của bạn ?</p>
    <p>-) Trong trường hợp thông tin cá nhân bị lộ do bị xâm phạm bảo mật, chúng tôi sẽ thông báo kịp thời đến các
        khách hàng theo luật pháp hiện hành. Nếu sự xâm phạm bảo mật diễn ra do những nguyên nhân sau đây, bạn đồng
        ý rằng chúng tôi sẽ không phải chịu trách nhiệm trong bất kỳ hoàn cảnh nào:</p>
    <p>+) Chính quyền hoặc các cơ quan tư pháp lấy dữ liệu từ chúng tôi, tuân theo luật pháp hiện hành, các chính
        sách quản lý, các sắc lệnh hành chính hoặc tư pháp hoặc trên cơ sở pháp lý khác.</p>
    <p>+) Tiết lộ hoặc để lộ bất kỳ thông tin cá nhân nào từ chính hành động chia sẻ hay rò rỉ tài khoản hoặc mật
        khẩu của người dùng.</p>
    <p>+) Bất kỳ sự để lộ thông tin nào do hack, virus máy tính, trojan hoặc các tội phảm ảo khác, hoặc do hỏng hóc
        hệ thống hay hỏng hóc truyền thông, trong đó, việc ngăn chặn những sự cố như vậy với công nghệ hiện tại là
        không thực tế về thương mại.</p>
    <p>+) Trong trường hợp khẩn cấp, khi gây nguy hiểm công cộng hoặc mạng sống, sức khỏe hoặc tài sản người khác,
        thông tin của bạn sẽ được tiết lộ để xoa dịu tình hình. Nếu kết quả là quyền của bạn bị xâm hại, bạn có thể
        yêu cầu bồi thường từ người hưởng lợi của những sự kiện này theo pháp luật hiện hành.</p>
    <p>+) Bất kỳ sự tiết lộ thông tin nào của bạn trong trường hợp bất khả kháng, hoặc vì lý do nào khác không phải
        do Công ty.</p>

    <p>CƠ SỞ PHÁP LÝ ĐỂ THU THẬP VÀ XỬ LÝ THÔNG TIN CỦA BẠN</p>
    <p>-) Luật pháp ở một số vùng tài phán yêu cầu các công ty cho bạn biết về cơ sở pháp lý họ dựa vào để thu thập,
        sử dụng và tiết lộ thông tin cá nhân của bạn. Theo mức độ áp dụng của những luật này, cơ sở pháp lý của
        chúng tôi bao gồm nhưng không giới hạn trong: +) Đa số việc xử lý dữ liệu cá nhân của chúng tôi đều nhằm đáp
        ứng nghĩa vụ hợp đồng của chúng tôi đối với người dùng, hoặc để thực hiện các yêu cầu người dùng được dự
        kiến khi ký hợp đồng với họ.</p>
    <p>+) Trong nhiều trường hợp, chúng tôi xử lý thông tin cá nhân trên cơ sở bảo vệ hoặc thúc đẩy lợi ích pháp lý
        của chúng tôi, người dùng và những người khác theo cách không vượt quá lợi ích hoặc quyền cơ bản và sự tự do
        của những cá nhân bị ảnh hưởng.</p>
    <p>+) Chúng tôi cần dùng và tiết lộ thông tin cá nhân theo những cách nhằm tuân thủ nghĩa vụ pháp lý của chúng
        tôi.</p>
    <p>+) Khi luật pháp hiện hành yêu cầu và trong một số trường hợp khác, chúng tôi sẽ xử lý thông tin cá nhân trên
        cơ sở đồng ý rõ ràng hoặc đồng ý ngầm của bạn.</p>
    <p>+) Khi áp dụng GDPR theo Điều 6 của GDPR.</p>

    <p>CÁC CHÍNH SÁCH BỔ SUNG</p>
    <p>1. Thông tin Tự nguyện</p>
    <p>Bạn có thể cung cấp cho chúng tôi ý tưởng cho những sản phẩm, dịch vụ mới hoặc cải thiện những cái hiện có
        cùng những thông tin tự nguyện khác (gọi chung là \"Thông tin Tự nguyện\"). Tất cả Thông tin Tự nguyện
        sẽ được xem là không bí mật và chúng tôi tự do tái sao chép, sử dụng, tiết lộ và phân phối những Thông tin
        Tự nguyện này cho người khác mà không cần giới hạn hay ghi nguồn.</p>
    <p>2. Liên kết đến Trang web hay Dịch vụ khác</p>
    <p>Chúng tôi không chịu trách nhiệm cho những tập quán của các trang web hay dịch vụ khác được liên kết đến hoặc
        từ Dịch vụ hay Trang web của chúng tôi, bao gồm những thông tin hay nội dung chứa ở đó. Khi bạn dùng liên
        kết từ Dịch vụ của chúng tôi đến trang web hay dịch vụ khác, Chính sách Quyền riêng tư này không áp dụng cho
        trang web hay dịch vụ của bên thứ ba. Trình duyệt và tương tác của bạn ở trang web hay dịch vụ của bên thứ
        ba, bao gồm những trang có liên kết hay quảng cáo trên trang web của chúng tôi, đều chịu sự kiểm soát của
        những quy tắc và chính sách của bên thứ ba đó.</p>
    <p>3. Quy trình Thông báo</p>
    <p>Chính sách của chúng tôi là đưa ra thông báo, dù cho thông báo đó được luật pháp yêu cầu hay vì mục đích
        marketing hoặc mục đích kinh doanh khác, qua e-mail, bằng văn bản hay bản cứng, hay thông qua đăng tải rõ
        ràng những thông báo này trên Dịch vụ, do chúng tôi toàn quyền quyết định. Chúng tôi giữ quyền xác định hình
        thức và phương tiện cung cấp thông báo cho bạn, giả sử rằng bạn đã bỏ một số phương tiện thông báo nhất định
        được mô tả trong Chính sách Quyền riêng tư này.</p>
    <p>4. Thay đổi Chính sách Quyền riêng tư này</p>
    <p>Tất cả thay đổi trong Chính sách Quyền riêng tư có thể được thực hiện bất kỳ lúc nào và vào những lúc chúng
        tôi xem là cần thiết và phù hợp, và nó sẽ có hiệu lực khi được đăng trên trang này. Khi chúng tôi thay đổi
        chính sách, chúng tôi sẽ gửi thông báo cho bạn qua e-mail và/hoặc thông báo nổi bật trên Trang web, Phần mềm
        và/hoặc Ứng dụng, trước khi thay đổi có hiệu lực. Nếu bạn không đồng ý với những thay đổi này, vui lòng
        ngừng truy cập và sử dụng Trang web, Phần mềm, Ứng dụng và những Dịch vụ khác.</p>
    <p>5. Hiệu lực:</p>
    <p>Văn bản này được viết bằng tiếng Việt và là văn bản duy nhất có hiệu lực. Chúng tôi có thể cung cấp bản dịch
        bằng những ngôn ngữ cho các khu vực khác mà chúng tôi hoạt động để tiện cho bạn.</p>
    <p>6. Liên hệ chúng tôi. Nếu bạn có bất kỳ thắc mắc nào về Chính sách Quyền riêng tư này hoặc quyền của bạn
        trong những luật bảo vệ dữ liệu hiện hành, bạn có thể liên hệ bộ phận hỗ trợ khách hàng tại:</p>
    <p>Lê chân - Hải phòng - Việt Nam</p>
    <p>hoặc E-mail : ifntltd@gmail.com</p>",
            'terms_of_use_html' => "<h2 style=\"text-align: center;\">
        ĐIỀU KHOẢN DỊCH VỤ
    </h2>

    <h3>
        1. GIỚI THIỆU
    </h3>

    <p>
        1.1 Chào mừng bạn đến với Nhà Sách Dung Anh. Trước khi sử dụng Nhà Sách Dung Anh hoặc tạo tài khoản Nhà Sách Dung Anh (“Tài Khoản”),
        vui lòng đọc kỹ các Điều Khoản Dịch Vụ dưới đây để hiểu rõ quyền lợi và nghĩa vụ hợp pháp của mình đối với Công ty TNHH Nhà Sách Dung Anh.
        “Dịch Vụ” chúng tôi cung cấp hoặc sẵn có bao gồm (a) Nhà Sách Dung Anh, (b) các dịch vụ được cung cấp bởi Nhà Sách Dung Anh và bởi phần mềm dành cho khách hàng của Nhà Sách Dung Anh có sẵn trên Nhà Sách Dung Anh, và (c) tất cả các thông tin, đường dẫn, tính năng, dữ liệu, văn bản, hình ảnh, tin nhắn, nội dung, chương trình. Bất kỳ tính năng mới nào được bổ sung hoặc mở rộng đối với Dịch Vụ đều thuộc phạm vi điều chỉnh của Điều Khoản Dịch Vụ này. Điều Khoản Dịch Vụ này điều chỉnh việc bạn sử dụng Dịch Vụ cung cấp bởi Nhà Sách Dung Anh.
    </p>

    <p>
        1.2       Trước khi trở thành Người Sử Dụng của Nhà Sách Dung Anh, bạn cần đọc và chấp nhận mọi điều khoản và điều kiện được quy định trong, và dẫn chiếu đến, Điều Khoản Dịch Vụ này và Chính Sách Bảo Mật được dẫn chiếu theo đây.
    </p>

    <p>
        1.3       Nhà Sách Dung Anh bảo lưu quyền thay đổi, chỉnh sửa, tạm ngưng hoặc chấm dứt tất cả hoặc bất kỳ phần nào của Nhà Sách Dung Anh hoặc Dịch Vụ vào bất cứ thời điểm nào theo quy định pháp luật. Phiên Bản thử nghiệm của Dịch Vụ hoặc tính năng của Dịch Vụ có thể không hoàn toàn giống với phiên bản cuối cùng.
    </p>

    <p>
        1.4       Nhà Sách Dung Anh bảo lưu quyền từ chối yêu cầu mở Tài Khoản hoặc các truy cập của bạn tới Nhà Sách Dung Anh hoặc Dịch Vụ theo quy định pháp luật và Điều khoản dịch vụ.

        BẰNG VIỆC SỬ DỤNG DỊCH VỤ HAY TẠO TÀI KHOẢN TẠI Nhà Sách Dung Anh, BẠN ĐÃ CHẤP NHẬN VÀ ĐỒNG Ý VỚI NHỮNG ĐIỀU KHOẢN DỊCH VỤ NÀY VÀ CHÍNH SÁCH BỔ SUNG ĐƯỢC DẪN CHIẾU THEO ĐÂY.

        NẾU BẠN KHÔNG ĐỒNG Ý VỚI NHỮNG ĐIỀU KHOẢN DỊCH VỤ NÀY, VUI LÒNG KHÔNG SỬ DỤNG DỊCH VỤ HOẶC TRUY CẬP VÀO Nhà Sách Dung Anh. NẾU BẠN LÀ NGƯỜI CHƯA THÀNH NIÊN HOẶC BỊ GIỚI HẠN VỀ NĂNG LỰC HÀNH VI DÂN SỰ THEO QUY ĐỊNH PHÁP LUẬT TẠI QUỐC GIA BẠN SINH SỐNG, BẠN CẦN NHẬN ĐƯỢC SỰ HỖ TRỢ HOẶC CHẤP THUẬN TỪ CHA MẸ HOẶC NGƯỜI GIÁM HỘ HỢP PHÁP, TÙY TỪNG TRƯỜNG HỢP ÁP DỤNG, ĐỂ MỞ TÀI KHOẢN HOẶC SỬ DỤNG DỊCH VỤ. TRONG TRƯỜNG HỢP ĐÓ, CHA MẸ HOẶC NGƯỜI GIÁM HỘ HỢP PHÁP, TÙY TỪNG TRƯỜNG HỢP ÁP DỤNG, CẦN HỖ TRỢ ĐỂ BẠN HIỂU RÕ HOẶC THAY MẶT BẠN CHẤP NHẬN NHỮNG ĐIỀU KHOẢN TRONG THỎA THUẬN DỊCH VỤ NÀY. NẾU BẠN CHƯA CHẮC CHẮN VỀ ĐỘ TUỔI CŨNG NHƯ NĂNG LỰC HÀNH VI DÂN SỰ CỦA MÌNH, HOẶC CHƯA HIỂU RÕ CÁC ĐIỀU KHOẢN NÀY CŨNG NHƯ QUY ĐỊNH PHÁP LUẬT CÓ LIÊN QUAN ÁP DỤNG CHO ĐỘ TUỔI HOẶC NĂNG LỰC HÀNH VI DÂN SỰ CỦA MÌNH, VUI LÒNG KHÔNG TẠO TÀI KHOẢN HOẶC SỬ DỤNG DỊCH VỤ CHO ĐẾN KHI NHẬN ĐƯỢC SỰ GIÚP ĐỠ TỪ CHA MẸ HOẶC NGƯỜI GIÁM HỘ HỢP PHÁP. NẾU BẠN LÀ CHA MẸ HOẶC NGƯỜI GIÁM HỘ HỢP PHÁP CỦA NGƯỜI CHƯA THÀNH NIÊN HOẶC BỊ GIỚI HẠN VỀ NĂNG LỰC HÀNH VI DÂN SỰ, TÙY TỪNG TRƯỜNG HỢP THEO QUY ĐỊNH PHÁP LUẬT, BẠN CẦN HỖ TRỢ ĐỂ NGƯỜI ĐƯỢC GIÁM HỘ HIỂU RÕ HOẶC ĐẠI DIỆN NGƯỜI ĐƯỢC GIÁM HỘ CHẤP NHẬN CÁC ĐIỀU KHOẢN DỊCH VỤ NÀY VÀ CHỊU TRÁCH NHIỆM ĐỐI VỚI TOÀN BỘ QUÁ TRÌNH SỬ DỤNG TÀI KHOẢN HOẶC CÁC DỊCH VỤ CỦA Nhà Sách Dung Anh  MÀ KHÔNG PHÂN BIỆT TÀI KHOẢN ĐÃ  HOẶC SẼ ĐƯỢC TẠO LẬP.
    </p>


    <h3>
        2.         QUYỀN RIÊNG TƯ
    </h3>

    <p>
        2.1       Nhà Sách Dung Anh coi trọng việc bảo mật thông tin của bạn. Để bảo vệ quyền lợi người dùng, Nhà Sách Dung Anh cung cấp Chính Sách Bảo Mật tại Nhà Sách Dung Anh.vn để giải thích chi tiết các hoạt động bảo mật của Nhà Sách Dung Anh. Vui lòng tham khảo Chính Sách Bảo Mật để biết cách thức Nhà Sách Dung Anh thu thập và sử dụng thông tin liên quan đến Tài Khoản và/hoặc việc sử dụng Dịch Vụ của Người Sử Dụng (“Thông Tin Người Sử Dụng”). Điều Khoản Dịch Vụ này có liên quan mật thiết với Chính Sách Bảo Mật. Bằng cách sử dụng Dịch Vụ hoặc cung cấp thông tin trên Nhà Sách Dung Anh, Người Sử Dụng:
    </p>

    <p>
        a.        Bạn cho phép Nhà Sách Dung Anh thu thập, sử dụng, công bố và/hoặc xử lý các Nội Dung, dữ liệu cá nhân của bạn và Thông Tin Người Sử Dụng như được quy định trong Chính Sách Bảo Mật;
    </p>

    <p>
        b.        Bạn đồng ý và công nhận rằng các thông tin được cung cấp trên Nhà Sách Dung Anh sẽ thuộc sở hữu chung của bạn và Nhà Sách Dung Anh;
    </p>

    <p>
        c.        Chúng tôi sẽ không, dù là trực tiếp hay gián tiếp, tiết lộ các Thông Tin Người Sử Dụng cho bất kỳ bên thứ ba nào, hoặc bằng bất kỳ phương thức nào cho phép bất kỳ bên thứ ba nào được truy cập hoặc sử dụng Thông Tin Người Dùng của bạn.
    </p>


    <p>
        2.2       Trường hợp Người Sử Dụng sở hữu dữ liệu cá nhân của Người Sử Dụng khác thông qua việc sử dụng Dịch Vụ (“Bên Nhận Thông Tin”) theo đây đồng ý rằng, mình sẽ (i) tuân thủ mọi quy định pháp luật về bảo vệ an toàn thông tin cá nhân liên quan đến những thông tin đó; (ii) cho phép Người Sử Dụng là chủ sở hữu của các thông tin cá nhân mà Bên Nhận Thông Tin thu thập được (“Bên Tiết Lộ Thông Tin”) được phép xóa bỏ thông tin của mình được thu thập từ cơ sở dữ liệu của Bên Nhận Thông Tin; và (iii) cho phép Bên Tiết Lộ Thông Tin rà soát những thông tin đã được thu thập về họ bởi Bên Nhận Thông Tin, phù hợp với hoặc theo yêu cầu của các quy định pháp luật hiện hành.
    </p>

    <h3>
        3.         GIỚI HẠN TRÁCH NHIỆM
    </h3>

    <p>
        3.1       Nhà Sách Dung Anh trao cho Người Sử Dụng quyền phù hợp để truy cập và sử dụng các Dịch Vụ theo các điều khoản và điều kiện được quy định trong Điều Khoản Dịch Vụ này. Tất cả các Nội Dung, thương hiệu, nhãn hiệu dịch vụ, tên thương mại, biểu tượng và tài sản sở hữu trí tuệ khác độc quyền (“Tài Sản Sở Hữu Trí Tuệ”) hiển thị trên Nhà Sách Dung Anh đều thuộc sở hữu của Nhà Sách Dung Anh và bên sở hữu thứ ba, nếu có. Không một bên nào truy cập vào Nhà Sách Dung Anh được cấp quyền hoặc cấp phép trực tiếp hoặc gián tiếp để sử dụng hoặc sao chép bất kỳ Tài Sản Sở Hữu Trí Tuệ nào, cũng như không một bên nào truy cập vào Nhà Sách Dung Anh được phép truy đòi bất kỳ quyền, quyền sở hữu hoặc lợi ích nào liên quan đến Tài Sản Sở Hữu Trí Tuệ. Bằng cách sử dụng hoặc truy cập Dịch Vụ, bạn đồng ý tuân thủ các quy định pháp luật liên quan đến bản quyền, thương hiệu, nhãn hiệu dịch vụ hoặc bất cứ quy định pháp luật nào khác bảo vệ Dịch Vụ, Nhà Sách Dung Anh và Nội Dung của Nhà Sách Dung Anh. Bạn đồng ý không được phép sao chép, phát tán, tái bản, chuyển giao, công bố công khai, thực hiện công khai, sửa đổi, phỏng tác, cho thuê, bán, hoặc tạo ra các sản phẩm phái sinh của bất cứ phần nào thuộc Dịch Vụ, Nhà Sách Dung Anh và Nội Dung của Nhà Sách Dung Anh. Bạn không được nhân bản hoặc chỉnh sửa bất kỳ phần nào hoặc toàn bộ nội dung của Nhà Sách Dung Anh trên bất kỳ máy chủ hoặc như là một phần của bất kỳ website nào khác mà chưa nhận được sự chấp thuận bằng văn bản của Nhà Sách Dung Anh. Ngoài ra, bạn đồng ý rằng bạn sẽ không sử dụng bất kỳ robot, chương trình do thám (spider) hay bất kỳ thiết bị tự động hoặc phương thức thủ công nào để theo dõi hoặc sao chép Nội Dung của Nhà Sách Dung Anh khi chưa có sự đồng ý trước bằng văn bản của Nhà Sách Dung Anh (sự chấp thuận này được xem như áp dụng cho các công cụ tìm kiếm cơ bản trên các website tìm kiếm trên mạng kết nối người dùng trực tiếp đến website đó).
    </p>

    <p>
        3.2       Nhà Sách Dung Anh cho phép kết nối từ website Người Sử Dụng đến Nhà Sách Dung Anh, với điều kiện website của Người Sử Dụng không được hiểu là bất kỳ việc xác nhận hoặc liên quan nào đến Nhà Sách Dung Anh.
    </p>

    <h3>
        4.         PHẦN MỀM
    </h3>

    <p>
        Bất kỳ phần mềm nào được cung cấp bởi Nhà Sách Dung Anh tới Người Sử Dụng đều thuộc phạm vi điều chỉnh của các Điều Khoản Dịch Vụ này. Nhà Sách Dung Anh bảo lưu tất cả các quyền liên quan đến phần mềm không được cấp một các rõ ràng bởi Nhà Sách Dung Anh theo đây. Bất kỳ tập lệnh hoặc mã code, liên kết đến hoặc dẫn chiếu từ Dịch Vụ, đều được cấp phép cho bạn bởi các bên thứ ba là chủ sở hữu của tập lệnh hoặc mã code đó chứ không phải bởi Nhà Sách Dung Anh.
    </p>

    <h3>
        5.         TÀI KHOẢN VÀ BẢO MẬT
    </h3>

    <p>
        5.1       Một vài tính năng của Dịch Vụ chúng tôi yêu cầu phải đăng ký một Tài Khoản bằng cách lựa chọn một tên người sử dụng không trùng lặp (“Tên Đăng Nhập”) và mật khẩu đồng thời cung cấp một số thông tin cá nhân nhất định. Bạn có thể sử dụng Tài Khoản của mình để truy cập vào các sản phẩm, website hoặc dịch vụ khác mà Nhà Sách Dung Anh cho phép, có mối liên hệ hoặc đang hợp tác. Nhà Sách Dung Anh không kiểm tra và không chịu trách nhiệm đối với bất kỳ nội dung, tính năng năng, bảo mật, dịch vụ, chính sách riêng tư, hoặc cách thực hiện khác của các sản phẩm, website hay dịch vụ đó. Trường hợp bạn sử dụng Tài Khoản của mình để truy cập vào các sản phẩm, website hoặc dịch vụ khác mà Nhà Sách Dung Anh cho phép, có mối liên hệ hoặc đang hợp tác, các điều khoản dịch vụ của những sản phẩm, website hoặc dịch vụ đó, bao gồm các chính sách bảo mật tương ứng vẫn được áp dụng khi bạn sử dụng các sản phẩm, website hoặc dịch vụ đó ngay cả khi những điều khoản dịch vụ này khác với Điều Khoản Dịch Vụ và/hoặc Chính Sách Bảo Mật của Nhà Sách Dung Anh.
    </p>

    <p>
        5.2       Bạn đồng ý (a) giữ bí mật mật khẩu và chỉ sử dụng Tên Đăng Nhập và mật khẩu khi đăng nhập, (b) đảm bảo bạn sẽ đăng xuất khỏi tài khoản của mình sau mỗi phiên đăng nhập trên Nhà Sách Dung Anh, và (c) thông báo ngay lập tức với Nhà Sách Dung Anh nếu phát hiện bất kỳ việc sử dụng trái phép nào đối với Tài Khoản, Tên Đăng Nhập và/hoặc mật khẩu của bạn. Bạn phải chịu trách nhiệm với hoạt động dưới Tên Đăng Nhập và Tài Khoản của mình, bao gồm tổn thất hoặc thiệt hại phát sinh từ việc sử dụng trái phép liên quan đến mật khẩu hoặc từ việc không tuân thủ Điều Khoản này của Người Sử Dụng.
    </p>

    <p>
        5.3       Bạn đồng ý rằng Nhà Sách Dung Anh có toàn quyền xóa Tài Khoản và Tên Đăng Nhập của Người Sử Dụng ngay lập tức, gỡ bỏ hoặc hủy từ Nhà Sách Dung Anh bất kỳ Nội Dung nào liên quan đến Tài Khoản và Tên Đăng Nhập của Người Sử Dụng với bất kỳ lý do nào mà có hoặc không cần thông báo hay chịu trách nhiệm với Người Sử Dụng hay bên thứ ba nào khác. Căn cứ để thực hiện các hành động này có thể bao gồm (a) Tài Khoản và Tên Đăng Nhập không hoạt động trong thời gian dài, (b) vi phạm điều khoản hoặc tinh thần của các Điều Khoản Dịch Vụ này, (c) có hành vi bất hợp pháp, lừa đảo, quấy rối, xâm phạm, đe dọa hoặc lạm dụng, (d) có nhiều tài khoản người dùng khác nhau, (e) mua sản phẩm trên Nhà Sách Dung Anh với mục đích kinh doanh, (f) mua hàng số lượng lớn từ một Người Bán hoặc một nhóm Người Bán có liên quan, (g) lạm dụng mã giảm giá hoặc tài trợ hoặc quyền lợi khuyến mại (bao gồm việc bán mã giảm giá cho các bên thứ ba cũng như lạm dụng mã giảm giá ở Nhà Sách Dung Anh), (h) có hành vi gây hại tới những Người Sử Dụng khác, các bên thứ ba hoặc các lợi ích kinh tế của Nhà Sách Dung Anh. Việc sử dụng Tài Khoản cho các mục đích bất hợp pháp, lừa đảo, quấy rối, xâm phạm, đe dọa hoặc lạm dụng có thể được gửi cho cơ quan nhà nước có thẩm quyền theo quy định pháp luật.
    </p>

    <p>
        5.4       Người Sử Dụng có thể yêu cầu xóa tài khoản bằng cách thông báo bằng văn bản đến Nhà Sách Dung Anh (tại đây). Tuy nhiên, Người Sử Dụng vẫn phải chịu trách nhiệm và nghĩa vụ đối với bất kỳ giao dịch nào chưa hoàn thành (phát sinh trước hoặc sau khi tài khoản bị xóa) hay việc vận chuyển hàng hóa liên quan đến tài khoản bị yêu cầu xóa. Khi đó, theo Điều Khoản Dịch Vụ, Người Sử Dụng phải liên hệ với Nhà Sách Dung Anh sau khi đã nhanh chóng và hoàn tất việc thực hiện và hoàn thành các giao dịch chưa hoàn tất. Người Sử Dụng chịu trách nhiệm đối với yêu cầu xóa tài khoản của mình.
    </p>

    <p>
        5.5       Bạn chỉ có thể sử dụng Dịch Vụ và/hoặc mở Tài Khoản tại Nhà Sách Dung Anh nếu bạn đáp ứng đủ các điều kiện để chấp nhận Điều Khoản Dịch Vụ này.
    </p>

    <h3>
        6.         ĐIỀU KHOẢN SỬ DỤNG
    </h3>

    <p>
        6.1       Quyền được phép sử dụng Nhà Sách Dung Anh và Dịch Vụ có hiệu lực cho đến khi bị chấm dứt. Quyền được phép sử dụng sẽ bị chấm dứt theo Điều Khoản Dịch Vụ này hoặc trường hợp Người Sử Dụng vi phạm bất cứ điều khoản hoặc điều kiện nào được quy định tại Điều Khoản Dịch Vụ này. Trong trường hợp đó, Nhà Sách Dung Anh có thể chấm dứt việc sử dụng của Người Sử Dụng bằng hoặc không cần thông báo.
    </p>

    <p>
        6.2       Người Sử Dụng không được phép:
    </p>

    <p>
        (a)        tải lên, đăng, truyền tải hoặc bằng cách khác công khai bất cứ Nội Dung nào trái pháp luật, có hại, đe dọa, lạm dụng, quấy rối, gây hoang mang, lo lắng, xuyên tạc, phỉ báng, xúc phạm, khiêu dâm, bôi nhọ, xâm phạm quyền riêng tư của người khác, gây căm phẫn, hoặc phân biệt chủng tộc, dân tộc hoặc bất kỳ nội dung không đúng đắn nào khác;
    </p>

    <p>
        (b)        vi phạm pháp luật, quyền lợi của bên thứ ba hoặc Chính Sách Cấm/Hạn Chế Sản Phẩm của Nhà Sách Dung Anh;
    </p>

    <p>
        (c)        đăng tải, truyền tin, hoặc bằng bất kỳ hình thức nào khác hiển thị bất kỳ Nội dung nào có sự xuất hiện của người chưa thành niên hoặc sử dụng Dịch vụ gây tổn hại cho người chưa thành niên dưới bất kỳ hình thức nào;
    </p>

    <p>
        (d)        sử dụng Dịch Vụ hoặc đăng tải Nội Dung để mạo danh bất kỳ cá nhân hoặc tổ chức nào, hoặc bằng cách nào khác xuyên tạc cá nhân hoặc tổ chức;
    </p>

    <p>
        (e)        giả mạo các tiêu đề hoặc bằng cách khác ngụy tạo các định dạng nhằm che giấu nguồn gốc của bất kỳ Nội Dung nào được truyền tải thông qua Dịch Vụ;
    </p>

    <p>
        (f)        gỡ bỏ bất kỳ thông báo độc quyền nào từ Nhà Sách Dung Anh;
    </p>

    <p>
        (g)        gây ra, chấp nhận hoặc ủy quyền cho việc sửa đổi, cấu thành các sản phẩm phái sinh, hoặc chuyển thể của Dịch Vụ mà không được sự cho phép rõ ràng của Nhà Sách Dung Anh;
    </p>

    <p>
        (h)        sử dụng Dịch Vụ phục vụ lợi ích của bất kỳ bên thứ ba nào hoặc bất kỳ hành vi nào không được chấp nhận theo Điều Khoản Dịch Vụ này;
    </p>

    <p>
        6.3       Người Sử Dụng hiểu rằng các Nội Dung, dù được đăng công khai hoặc truyền tải riêng tư, là hoàn toàn thuộc trách nhiệm của người đã tạo ra Nội Dung đó. Điều đó nghĩa là bạn, không phải Nhà Sách Dung Anh, phải hoàn toàn chịu trách nhiệm đối với những Nội Dung mà bạn tải lên, đăng, gửi thư điện tử, chuyển tải hoặc bằng cách nào khác công khai trên Nhà Sách Dung Anh. Người Sử Dụng hiểu rằng bằng cách sử dụng Nhà Sách Dung Anh, bạn có thể gặp phải Nội Dung mà bạn cho là phản cảm, không đúng đắn hoặc chưa phù hợp. Nhà Sách Dung Anh sẽ không chịu trách nhiệm đối với Nội Dung, bao gồm lỗi hoặc thiếu sót liên quan đến Nội Dung, hoặc tổn thất hoặc thiệt hại xuất phát từ việc sử dụng, hoặc dựa trên, Nội Dung được đăng tải, gửi thư, chuyển tải hoặc bằng cách khác công bố trên Nhà Sách Dung Anh.
    </p>

    <p>
        6.4       Người Sử Dụng thừa nhận rằng Nhà Sách Dung Anh và các bên được chỉ định của mình có toàn quyền (nhưng không có nghĩa vụ) sàng lọc, từ chối, xóa, dừng, tạm dừng, gỡ bỏ hoặc dời bất kỳ Nội Dung có sẵn trên Nhà Sách Dung Anh, bao gồm bất kỳ Nội Dung hoặc thông tin nào bạn đã đăng.  Nhà Sách Dung Anh có quyền gỡ bỏ Nội Dung (i) xâm phạm đến Điều Khoản Dịch Vụ; (ii) trong trường hợp Nhà Sách Dung Anh nhận được khiếu nại hơp lệ theo quy định pháp luật từ Người Sử Dụng khác; (iii) trong trường hợp Nhà Sách Dung Anh nhận được thông báo hợp lệ về vi phạm quyền sở hữu trí tuệ hoặc yêu cầu pháp lý cho việc gỡ bỏ; hoặc (iv) những nguyên nhân khác theo quy định pháp luật. Nhà Sách Dung Anh có quyền chặn các liên lạc (bao gồm việc cập nhật trạng thái, đăng tin, truyền tin và/hoặc tán gẫu) về hoặc liên quan đến Dịch Vụ như nỗ lực của chúng tôi nhằm bảo vệ Dịch Vụ hoặc Người Sử Dụng của Nhà Sách Dung Anh, hoặc bằng cách khác thi hành các điều khoản trong Điều Khoản Dịch Vụ này. Người Sử Dụng đồng ý rằng mình phải đánh giá, và chịu mọi rủi ro liên quan đến, việc sử dụng bất kỳ Nội Dung nào, bao gồm bất kỳ việc dựa vào tính chính xác, đầy đủ, hoặc độ hữu dụng của Nội Dung đó. Liên quan đến vấn đề này, Người Sử Dụng thừa nhận rằng mình không phải và, trong giới hạn tối đa pháp luật cho phép, không cần dựa vào bất kỳ Nội Dung nào được tạo bởi Nhà Sách Dung Anh hoặc gửi cho Nhà Sách Dung Anh, bao gồm các thông tin trên các Diễn Đàn Nhà Sách Dung Anh hoặc trên các phần khác của Nhà Sách Dung Anh.
    </p>

    <p>
        6.5       Người Sử Dụng chấp thuận và đồng ý rằng Nhà Sách Dung Anh có thể truy cập, duy trì và tiết lộ thông tin Tài Khoản của Người Sử Dụng trong trường hợp pháp luật có yêu cầu hoặc theo lệnh của tòa án hoặc cơ quan chính phủ hoặc cơ quan nhà nước có thẩm quyền yêu cầu Nhà Sách Dung Anh hoặc những nguyên nhân khác theo quy định pháp luật: (a) tuân thủ các thủ tục pháp luật; (b) thực thi Điều Khoản Dịch Vụ; (c) phản hồi các khiếu nại về việc Nội Dung xâm phạm đến quyền lợi của bên thứ ba; (d) phản hồi các yêu cầu của Người Sử Dụng liên quan đến chăm sóc khách hàng; hoặc (e) bảo vệ các quyền, tài sản hoặc an toàn của Nhà Sách Dung Anh, Người Sử Dụng và/hoặc cộng đồng.
    </p>

    <h3>
        7.         VI PHẠM ĐIỀU KHOẢN DỊCH VỤ
    </h3>

    <p>
        7.1       Việc vi phạm chính sách này có thể dẫn tới một số hành động, bao gồm bất kỳ hoặc tất cả các hành động sau:
    </p>

    <p>
        -           Giới hạn quyền sử dụng Tài Khoản;
    </p>

    <p>
        -           Đình chỉ và chấm dứt Tài Khoản;
    </p>

    <p>
        -           Cáo buộc hình sự;
    </p>

    <p>
        -           Áp dụng biện pháp dân sự, bao gồm khiếu nại bồi thường thiệt hại và/hoặc áp dụng biện pháp khẩn cấp tạm thời;
    </p>

    <p>
        -           Các hành động hoặc biện pháp chế tài khác theo Tiêu Chuẩn Cộng Đồng, Quy Chế Hoạt Động, hoặc các Chính Sách Nhà Sách Dung Anh.
    </p>

    <p>
        7.2       Nếu bạn phát hiện Người Sử Dụng trên Nhà Sách Dung Anh của chúng tôi có hành vi vi phạm Điều Khoản Dịch Vụ, vui lòng liên hệ Nhà Sách Dung Anh Tại đây.
    </p>

    <h3>
        8.       PHẢN HỒI
    </h3>

    <p>
        8.1     Nhà Sách Dung Anh luôn đón nhận những thông tin và phản hồi từ phía Người Sử Dụng nhằm giúp Nhà Sách Dung Anh cải thiện chất lượng Dịch Vụ. Vui lòng xem thêm quy trình phản hồi của Nhà Sách Dung Anh dưới đây:
    </p>

    <p>
        (i)        Phản hồi cần được thực hiện bằng văn bản qua email hoặc sử dụng mẫu.
    </p>

    <p>
        (i)       Tất cả các phản hồi ẩn danh đều không được chấp nhận.
    </p>

    <p>
        (iii)       Người Sử Dụng liên quan đến phản hồi sẽ được thông báo đầy đủ và được tạo cơ hội cải thiện tình hình.
    </p>

    <p>
        (iv)        Những phản hồi không rõ ràng và mang tính phỉ báng sẽ không được chấp nhận
    </p>

    <h3>
        9.       LOẠI TRỪ TRÁCH NHIỆM
    </h3>

    <p>
        9.1     DỊCH VỤ ĐƯỢC CUNG CẤP NHƯ ‘SẴN CÓ’ VÀ KHÔNG CÓ BẤT KỲ SỰ ĐẢM BẢO, KHIẾU NẠI HOẶC KHẲNG ĐỊNH NÀO TỪ Nhà Sách Dung Anh VỀ BẤT KỲ NỘI DUNG NÀO ĐƯỢC THỂ HIỆN, NGỤ Ý HOẶC BẮT BUỘC ĐỐI VỚI DỊCH VỤ, BAO GỒM VIỆC ĐẢM BẢO VỀ CHẤT LƯỢNG, VIỆC THỰC HIỆN, KHÔNG VI PHẠM, VIỆC MUA BÁN, HAY SỰ PHÙ HỢP CHO MỘT MỤC ĐÍCH CỤ THỂ.
    </p>

    <h3>
        10.       ĐÓNG GÓP CỦA NGƯỜI SỬ DỤNG ĐỐI VỚI DỊCH VỤ
    </h3>

    <p>
        10.1     Khi gửi bất kỳ Nội Dung nào cho Nhà Sách Dung Anh, bạn khẳng định và bảo đảm rằng bạn đã có đầy đủ tất cả các quyền và/hoặc các chấp thuận cần thiết để cấp các quyền dưới đây cho Nhà Sách Dung Anh. Bạn cũng thừa nhận và đồng ý rằng bạn là người chịu trách nhiệm duy nhất đối với bất cứ nội dung gì bạn đăng tải hoặc tạo sẵn trên hoặc qua Dịch Vụ, bao gồm trách nhiệm về độ chính xác, độ tin cậy, tính nguyên bản, rõ ràng các quyền, tính tuân thủ pháp luật và các giới hạn pháp lý liên quan đến bất kỳ Nội Dung đóng góp nào. Người Sử Dụng theo đây cấp quyền cho Nhà Sách Dung Anh và các bên kế thừa của Nhà Sách Dung Anh, một cách liên tục, không hủy ngang, mang tính toàn cầu, không độc quyền, không tiền bản quyền, có thể cấp quyền lại và có thể chuyển giao, quyền sử dụng, sao chép, phân phối, tái bản, chuyển giao, thay đổi, chỉnh sửa, tạo các sản phẩm phái sinh từ, thể hiện công khai, và thực hiện Nội Dung đóng góp đó, thông qua hoặc liên quan đến Dịch Vụ dưới bất kỳ phương tiện truyền thông nào và thông qua bất kỳ kênh truyền thông nào, bao gồm cho mục đích khuyến mãi hoặc phân phối lại một phần Dịch Vụ (hoặc các sản phẩm phái sinh của Dịch Vụ). Quyền mà bạn trao cho chúng tôi chỉ chấm dứt khi bạn hoặc Nhà Sách Dung Anh loại bỏ Nội Dung đóng góp ra khỏi Dịch Vụ. Bạn hiểu rằng sự đóng góp của bạn có thể được chuyển giao sang nhiều hệ thống khác nhau và được thay đổi để phù hợp và đáp ứng các yêu cầu về kỹ thuật.
    </p>

    <p>
        10.2     Bất kỳ Nội Dung, tài liệu, thông tin hoặc ý tưởng nào Người Sử Dụng đăng tải hoặc thông qua Dịch Vụ, hoặc bằng cách khác chuyển giao cho Nhà Sách Dung Anh dưới bất kỳ hình thức nào (mỗi hình thức được gọi là “Nội Dung Gửi”), sẽ không được bảo mật bởi Nhà Sách Dung Anh và có thể được phổ biến hoặc sử dụng bởi Nhà Sách Dung Anh hoặc các công ty liên kết mà không phải trả phí hoặc chịu trách nhiệm với Người Sử Dụng, để phục vụ bất kỳ mục đích nào, bao gồm việc phát triển, sản xuất và quảng bá sản phẩm. Khi thực hiện Nội Dung Gửi đến Nhà Sách Dung Anh, bạn thừa nhận và đồng ý rằng Nhà Sách Dung Anh và/hoặc các bên thứ ba có thể độc lập phát triển các phần mềm, ứng dụng, giao diện, sản phẩm và chỉnh sửa và nâng cấp các phần mềm, ứng dụng, giao diện, sản phẩm mà chúng đồng nhất hoặc tương tự với các ý tưởng được nêu trong Nội Dung Gửi của bạn về chức năng, mã hoặc các đặc tính khác. Vì vậy, bạn theo đây trao cho Nhà Sách Dung Anh và các bên kế thừa của Nhà Sách Dung Anh, một cách liên tục, không hủy ngang, mang tính toàn cầu, không độc quyền, không tiền bản quyền, có thể cấp quyền lại và có thể chuyển giao, quyền sử dụng, sao chép, phân phối, tái bản, chuyển giao, thay đổi, chỉnh sửa, tạo các sản phẩm phái sinh từ, thể hiện công khai, và thực hiện Nội Dung Gửi đó, thông qua hoặc liên quan đến Nội Dung Gửi dưới bất kỳ phương tiện truyền thông nào và thông qua bất kỳ kênh truyền thông nào, bao gồm cho mục đích khuyến mãi hoặc phân phối lại một phần Dịch Vụ (hoặc các sản phẩm phái sinh của Dịch Vụ). Điều khoản này không áp dụng đối với các thông tin cá nhân là đối tượng của chính sách bảo mật của Nhà Sách Dung Anh trừ khi bạn công khai những thông tin đó trên hoặc thông qua Dịch Vụ.
    </p>

    <h3>
        11.       KHẲNG ĐỊNH VÀ ĐẢM BẢO CỦA NGƯỜI SỬ DỤNG
    </h3>

    <p>
        Người Sử Dụng khẳng định và đảm bảo rằng:
    </p>

    <p>
        (a)        Người Sử Dụng sở hữu năng lực, (và đối với trường hợp vị thành niên, có sự đồng ý hợp lệ từ cha mẹ hoặc người giám hộ hợp pháp), quyền và khả năng hợp pháp để giao kết các Điều Khoản Dịch Vụ này và để tuân thủ các điều khoản theo đó; và
    </p>

    <p>
        (b)        Người Sử Dụng chỉ sử dụng Dịch Vụ cho các mục đích hợp pháp và theo quy định của các Điều Khoản Dịch Vụ này cũng như tất cả các luật, quy tắc, quy chuẩn, chỉ thị, hướng dẫn, chính sách và quy định áp dụng.
    </p>

    <h3>
        12.       BỒI THƯỜNG
    </h3>

    <p>
        Bạn đồng ý bồi thường, bảo vệ và không gây hại cho Nhà Sách Dung Anh, các cổ đông, công ty con, công ty liên kết, giám đốc, viên chức, đại lý, đồng sở hữu thương hiệu hoặc đối tác, và nhân viên của Nhà Sách Dung Anh (gọi chung là “Bên Được Bồi Thường”) liên quan đến khiếu nại, hành động, thủ tục tố tụng, và các vụ kiện cũng như nghĩa vụ, tổn thất, thanh toán, khoản phạt, tiền phạt, chi phí và phí tổn có liên quan (bao gồm chi phí giải quyết tranh chấp) do Bên Được Bồi Thường gánh chịu, phát sinh từ (a) giao dịch được thực hiện trên Nhà Sách Dung Anh, hoặc tranh chấp liên quan đến giao dịch đó (trừ trường hợp Nhà Sách Dung Anh hoặc các công ty liên kết của Nhà Sách Dung Anh là Người Bán đối với giao dịch liên quan đến khiếu nại), (b) Chính Sách Đảm Bảo của Nhà Sách Dung Anh, (c) việc tổ chức, hoạt động, quản trị và/hoặc điều hành các Dịch Vụ được thực hiện bởi hoặc đại diện cho Nhà Sách Dung Anh, (d) vi phạm hoặc không tuân thủ bất kỳ điều khoản nào trong các Điều Khoản Dịch Vụ này hoặc bất kỳ chính sách hoặc hướng dẫn nào được tham chiếu theo đây, (e) việc bạn sử dụng hoặc sử dụng không đúng Dịch Vụ, hoặc (f) vi phạm của bạn đối với bất kỳ luật hoặc bất kỳ các quyền của bên thứ ba nào, hoặc (g) bất kỳ Nội Dung nào được đăng tải bởi Người Sử Dụng.
    </p>

    <h3>
        13.       LUẬT ÁP DỤNG
    </h3>

    <p>
        Các Điều Khoản Dịch Vụ này sẽ được điều chỉnh bởi và diễn giải theo luật pháp của Việt Nam. Bất kỳ tranh chấp, tranh cãi, khiếu nại hoặc sự bất đồng dưới bất cứ hình thức nào phát sinh từ hoặc liên quan đến các Điều Khoản Dịch Vụ này chống lại hoặc liên quan đến Nhà Sách Dung Anh hoặc bất kỳ Bên Được Bồi Thường nào thuộc đối tượng của các Điều Khoản Dịch Vụ này sẽ được giải quyết bằng Trung Tâm Trọng Tài Quốc Tế Việt Nam (VIAC).  Ngôn ngữ phán xử của trọng tài là Tiếng Việt.
    </p>

    <h3>
        14.       QUY ĐỊNH CHUNG
    </h3>

    <p>
        14.1     Nhà Sách Dung Anh bảo lưu tất cả các quyền lợi không được trao theo đây.
    </p>

    <p>
        14.2     Nhà Sách Dung Anh có quyền chỉnh sửa các Điều Khoản Dịch Vụ này vào bất cứ thời điểm nào thông qua việc đăng tải các Điều Khoản Dịch Vụ được chỉnh sửa lên Nhà Sách Dung Anh.  Việc Người Dùng tiếp tục sử dụng Nhà Sách Dung Anh sau khi việc thay đổi được đăng tải sẽ cấu thành việc Người Sử Dụng chấp nhận các Điều Khoản Dịch Vụ được chỉnh sửa.
    </p>


    THÔNG BÁO PHÁP LÝ: Xin vui lòng gửi tất cả các thông báo pháp lý đến Nhà Sách Dung Anh tại đây – Người nhận: Infinity Team.


    TÔI ĐÃ ĐỌC CÁC ĐIỀU KHOẢN DỊCH VỤ NÀY VÀ ĐỒNG Ý VỚI TẤT CẢ CÁC ĐIỀU KHOẢN NHƯ TRÊN CŨNG NHƯ BẤT KỲ ĐIỀU KHOẢN NÀO ĐƯỢC CHỈNH SỬA SAU NÀY.  BẰNG CÁCH BẤM NÚT “ĐĂNG KÝ” HOẶC “ĐĂNG KÝ QUA FACEBOOK” KHI ĐĂNG KÝ SỬ DỤNG Nhà Sách Dung Anh, TÔI HIỂU RẰNG TÔI ĐANG TẠO CHỮ KÝ ĐIỆN TỬ MÀ TÔI HIỂU RẰNG NÓ CÓ GIÁ TRỊ VÀ HIỆU LỰC TƯƠNG TỰ NHƯ CHỮ KÝ TÔI KÝ BẰNG TAY.


    Bản Cập Nhật ngày 02/08/2022.",
        ]);
    }
}
