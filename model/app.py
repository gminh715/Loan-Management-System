import os
import joblib
import pandas as pd
from flask import Flask, request, jsonify, render_template_string
from flask_cors import CORS

# Load model, scaler, and feature names
MODEL_PATH = "logistic_model_smote.joblib"
SCALER_PATH = "scaler_smote.joblib"
FEATURES_PATH = "feature_names_smote.joblib"

model = joblib.load(MODEL_PATH)
scaler = joblib.load(SCALER_PATH)
# Nếu chưa có file feature_names_smote.joblib, hãy tạo nó từ X_SMOTE.columns và lưu lại bằng joblib
try:
    feature_names = joblib.load(FEATURES_PATH)
except Exception:
    # Nếu chưa có file, lấy từ model training và lưu lại
    import numpy as np
    feature_names = model.feature_names_in_ if hasattr(model, "feature_names_in_") else None
    if feature_names is None:
        raise RuntimeError("Không tìm thấy feature_names. Hãy lưu lại feature_names_smote.joblib từ X_SMOTE.columns.")
    joblib.dump(feature_names, FEATURES_PATH)

app = Flask(__name__)
CORS(app)

HTML_FORM = """
<!DOCTYPE html>
<html>
<head>
    <title>Credit Default Prediction</title>
    <style>
        body { font-family: Arial; margin: 40px; }
        .container { max-width: 500px; margin: auto; }
        label { display: block; margin-top: 10px; }
        input[type=number] { width: 100%; padding: 6px; }
        select { width: 100%; padding: 6px; }
        button { margin-top: 20px; padding: 10px 20px; }
        .result { margin-top: 30px; font-size: 1.2em; }
    </style>
</head>
<body>
<div class="container">
    <h2>Dự đoán vỡ nợ thẻ tín dụng</h2>
    <form id="predictForm">
        <label>LIMIT_BAL: <input type="number" name="LIMIT_BAL" value="0" required></label>
        <label>AGE: <input type="number" name="AGE" value="0" required></label>
        <label>PAY_1: <input type="number" name="PAY_1" value="0" required></label>
        <label>PAY_2: <input type="number" name="PAY_2" value="0" required></label>
        <label>PAY_3: <input type="number" name="PAY_3" value="0" required></label>
        <label>PAY_4: <input type="number" name="PAY_4" value="0" required></label>
        <label>PAY_5: <input type="number" name="PAY_5" value="0" required></label>
        <label>PAY_6: <input type="number" name="PAY_6" value="0" required></label>
        <label>BILL_AMT1: <input type="number" name="BILL_AMT1" value="0" required></label>
        <label>BILL_AMT2: <input type="number" name="BILL_AMT2" value="0" required></label>
        <label>BILL_AMT3: <input type="number" name="BILL_AMT3" value="0" required></label>
        <label>BILL_AMT4: <input type="number" name="BILL_AMT4" value="0" required></label>
        <label>BILL_AMT5: <input type="number" name="BILL_AMT5" value="0" required></label>
        <label>BILL_AMT6: <input type="number" name="BILL_AMT6" value="0" required></label>
        <label>PAY_AMT1: <input type="number" name="PAY_AMT1" value="0" required></label>
        <label>PAY_AMT2: <input type="number" name="PAY_AMT2" value="0" required></label>
        <label>PAY_AMT3: <input type="number" name="PAY_AMT3" value="0" required></label>
        <label>PAY_AMT4: <input type="number" name="PAY_AMT4" value="0" required></label>
        <label>PAY_AMT5: <input type="number" name="PAY_AMT5" value="0" required></label>
        <label>PAY_AMT6: <input type="number" name="PAY_AMT6" value="0" required></label>
        <label>Giới tính:
            <select name="SEX">
                <option value="1">Nam</option>
                <option value="2">Nữ</option>
            </select>
        </label>
        <label>Học vấn:
            <select name="EDUCATION">
                <option value="1">Đại học</option>
                <option value="2">Khác</option>
                <option value="3">Trung học</option>
                <option value="4">Khác</option>
            </select>
        </label>
        <label>Hôn nhân:
            <select name="MARRIAGE">
                <option value="1">Độc thân</option>
                <option value="2">Đã kết hôn</option>
                <option value="3">Khác</option>
            </select>
        </label>
        <button type="submit">Dự đoán</button>
    </form>
    <div class="result" id="result"></div>
</div>
<script>
document.getElementById('predictForm').onsubmit = async function(e) {
    e.preventDefault();
    const form = e.target;
    // One-hot encoding cho các biến phân loại
    let data = {};
    for (let el of form.elements) {
        if (el.name) data[el.name] = Number(el.value);
    }
    // One-hot encoding cho SEX
    data['SEX_1'] = data['SEX'] === 1 ? 1 : 0;
    data['SEX_2'] = data['SEX'] === 2 ? 1 : 0;
    // One-hot encoding cho EDUCATION
    data['EDUCATION_1'] = data['EDUCATION'] === 1 ? 1 : 0;
    data['EDUCATION_2'] = data['EDUCATION'] === 2 ? 1 : 0;
    data['EDUCATION_3'] = data['EDUCATION'] === 3 ? 1 : 0;
    data['EDUCATION_4'] = data['EDUCATION'] === 4 ? 1 : 0;
    // One-hot encoding cho MARRIAGE
    data['MARRIAGE_1'] = data['MARRIAGE'] === 1 ? 1 : 0;
    data['MARRIAGE_2'] = data['MARRIAGE'] === 2 ? 1 : 0;
    data['MARRIAGE_3'] = data['MARRIAGE'] === 3 ? 1 : 0;
    // Xóa các trường gốc
    delete data['SEX'];
    delete data['EDUCATION'];
    delete data['MARRIAGE'];
    const res = await fetch('/predict', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify(data)
    });
    const result = await res.json();
    document.getElementById('result').innerHTML =
        `<b>Prediction Result:</b> ${result.message}<br><b>Default Probability:</b> ${(result.probability*100).toFixed(2)}%`;
}
</script>
</body>
</html>
"""

@app.route("/", methods=["GET"])
def index():
    return render_template_string(HTML_FORM)

@app.route("/predict", methods=["POST"])
def predict():
    # Expecting JSON input
    data = request.get_json()
    if not data:
        return jsonify({"error": "No input data provided"}), 400

    # Prepare input DataFrame
    input_df = pd.DataFrame([data])
    for col in feature_names:
        if col not in input_df.columns:
            input_df[col] = 0
    input_df = input_df[list(feature_names)]
    input_scaled = scaler.transform(input_df)
    pred = model.predict(input_scaled)
    prob = model.predict_proba(input_scaled)
    result = {
        "prediction": int(pred[0]),
        "probability": float(prob[0][1]),
        "message": "Default" if pred[0] == 1 else "Non-Default"
    }
    return jsonify(result)

@app.route("/save-model", methods=["POST"])
def save_model():
    """
    Lưu lại model, scaler và feature_names lên server (thư mục hiện tại của Flask app).
    Gửi POST request tới endpoint này để lưu lại model hiện tại.
    """
    try:
        joblib.dump(model, "logistic_model_smote.joblib")
        joblib.dump(scaler, "scaler_smote.joblib")
        joblib.dump(feature_names, "feature_names_smote.joblib")
        return jsonify({"message": "Model, scaler, and feature_names saved successfully."})
    except Exception as e:
        return jsonify({"error": str(e)}), 500

if __name__ == "__main__":
    # For local debug only; use gunicorn or similar for production
    app.run(host="0.0.0.0", port=5000)
