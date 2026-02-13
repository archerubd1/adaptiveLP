import sys
import mysql.connector
from feature_builder import build_features
from ranker import rank

learner_id = sys.argv[1]

df = build_features(learner_id)
recs = rank(df)

db = mysql.connector.connect(
    host="localhost",
    user="db_user",
    password="db_password",
    database="astraal_lxp"
)

cursor = db.cursor()

cursor.execute("DELETE FROM adaptive_recommendations WHERE learner_id=%s", (learner_id,))

for r in recs:
    cursor.execute("""
    INSERT INTO adaptive_recommendations
    VALUES (%s, 'pathway', %s, %s, %s, NOW())
    """, (learner_id, r[0], float(r[1]), r[2]))

db.commit()
