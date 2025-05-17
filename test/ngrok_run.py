# This script starts ngrok and exposes your Flask app to the internet.
# Install pyngrok: pip install pyngrok

from pyngrok import ngrok
import subprocess

# Set your Flask app port
port = 5000

# Ensure ngrok disconnects previous tunnels before opening a new one
ngrok.kill()  # Add this line to avoid "address already in use" errors

# Open an HTTP tunnel on the specified port
public_url = ngrok.connect(port, bind_tls=True)
print(f" * ngrok tunnel available at: {public_url}")

# Tự động chạy Flask app (giả sử app.py là file Flask chính)
# Nếu bạn muốn chạy app.py cùng lúc với ngrok, bỏ comment dòng dưới:
# subprocess.Popen(["python", "app.py"])

# Nếu bạn đã chạy Flask app ở terminal khác, chỉ cần giữ lại phần ngrok như trên.
