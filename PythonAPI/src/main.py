from fastapi import FastAPI

app = FastAPI()

@app.get("/")
def get_hello():
    return {"message": "Hello", "id": 12345}