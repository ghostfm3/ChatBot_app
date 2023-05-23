# Dockerfile
# ベースイメージはnvidia/cuda:11.4.2-cudnn8-runtime-ubuntu20.04
FROM nvidia/cuda:11.4.2-cudnn8-runtime-ubuntu20.04

# 必要なパッケージをインストール
RUN apt-get update && apt-get install -y \
    python3 \
    python3-pip \
    git

# ワークディレクトリを設定
WORKDIR /app

# GPT-2のリポジトリをクローン
RUN git clone https://github.com/openai/gpt-2.git

# GPT-2の依存関係をインストール
RUN cd gpt-2 && pip3 install -r requirements.txt

# FastAPIとその依存関係をインストール
RUN pip3 install fastapi uvicorn torch transformers

# srcディレクトリをコピー
COPY src /app/src

# FastAPIアプリケーションを起動
CMD ["uvicorn", "src.main:app", "--host", "0.0.0.0", "--port", "8070"]