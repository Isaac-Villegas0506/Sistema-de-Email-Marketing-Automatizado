import sys
import json
import time
import random
import re

def validate_email(email):
    if not re.match(r"[^@]+@[^@]+\.[^@]+", email):
        return False
    
    time.sleep(random.uniform(0.01, 0.05)) 
    
    if random.random() < 0.05:
        return False
        
    return True

def main():
    if len(sys.argv) < 2:
        print(json.dumps({"error": "No se proporcionó ningún archivo"}))
        sys.exit(1)

    file_path = sys.argv[1]
    
    try:
        with open(file_path, 'r', encoding='utf-8') as f:
            lines = f.readlines()
    except Exception as e:
        print(json.dumps({"error": str(e)}))
        sys.exit(1)
        
    results = {
        "valid": [],
        "invalid": [],
        "total_processed": 0,
        "processing_time": 0
    }
    
    start_time = time.time()
    
    for line in lines:
        try:
            email = line.strip()
            if not email:
                continue
            
            email = email.split(',')[0].strip()

            if validate_email(email):
                results["valid"].append(email)
            else:
                results["invalid"].append(email)
        except:
            continue
            
    results["total_processed"] = len(results["valid"]) + len(results["invalid"])
    results["processing_time"] = round(time.time() - start_time, 4)
    
    print(json.dumps(results))

if __name__ == "__main__":
    main()
