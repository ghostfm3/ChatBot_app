from fastapi import FastAPI
#from res_gpt import generate_reply

app = FastAPI()

@app.post("/")
async def get_gpt(data:str):
    response = generate_reply(data)
    return {"prompt": f"{data}", "response": f"{response}"}
