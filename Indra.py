import requests
import json
import sys

y = sys.argv[1]
z = sys.argv[2]

pairs = [
    {'t1': str(y), 't2': str(z)}]

data = {'corpus': 'googlenews',
     'model': 'W2V',
     'language': 'EN',
     'scoreFunction': 'COSINE', 'pairs': pairs}

headers = {
    'content-type': "application/json"
}

res = requests.post("http://indra.lambda3.org/relatedness", data=json.dumps(data), headers=headers)
res.raise_for_status()

wholeDataJson = res.json()
pairsFromJson = wholeDataJson["pairs"]
listInPairs = pairsFromJson[0]
scoreOfStrings = listInPairs["score"]

print(scoreOfStrings)
# Used to print the whole JSON if needed --> print(res.json())
