package com.example.samys.testar;

import android.content.Context;
import android.support.v4.app.FragmentActivity;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.CheckBox;
import android.widget.ListView;
import android.widget.TextView;
import android.widget.Toast;

import java.util.ArrayList;
import java.util.Arrays;
import java.util.List;

public class MainActivity extends FragmentActivity {
    private Planet[] planets ;
    private ArrayAdapter<Planet> listAdapter ;
    List<String> where = new ArrayList<String>();

    /** Called when the activity is first created. */
    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        // Find the ListView resource.
        ListView mainListView = (ListView) findViewById( R.id.mainListView );

        // When item is tapped, toggle checked properties of CheckBox and Planet.
        mainListView.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick( AdapterView<?> parent, View item,
                                     int position, long id) {
                Planet planet = listAdapter.getItem( position );
                planet.toggleChecked();
                PlanetViewHolder viewHolder = (PlanetViewHolder) item.getTag();
                viewHolder.getCheckBox().setChecked( planet.isChecked() );
            }
        });


        // Create and populate planets.
        planets = (Planet[]) getLastCustomNonConfigurationInstance() ;
        if ( planets == null ) {
            planets = new Planet[] {
                    new Planet("Mercury","1"), new Planet("Venus","2"), new Planet("Earth","3")

            };
        }
        ArrayList<Planet> planetList = new ArrayList<Planet>();
        planetList.addAll( Arrays.asList(planets) );

        // Set our custom array adapter as the ListView's adapter.
        listAdapter = new PlanetArrayAdapter(this, planetList);
        mainListView.setAdapter( listAdapter );


    }

    /** Holds planet data. */
    private static class Planet {
        private String name = "" ;
        private boolean checked = false ;
        private String id="";
        public Planet() {}
        public Planet( String name, String id ) {
            this.name = name ;
            this.id=id;
        }
        public Planet( String name, boolean checked, String id ) {
            this.name = name ;
            this.checked = checked ;
        }
        public String getName() {
            return name;
        }
        public void setName(String name) {
            this.name = name;
        }
        public boolean isChecked() {
            return checked;
        }
        public void setChecked(boolean checked) {
            this.checked = checked;
        }
        public String toString() {
            return name ;
        }
        public void toggleChecked() {
            checked = !checked ;
        }

        public String getId() {
            return id;
        }

        public void setId(String id) {
            this.id = id;
        }
    }

    /** Holds child views for one row. */
    private class PlanetViewHolder {
        private CheckBox checkBox ;
        private TextView textView ;
        public PlanetViewHolder() {}
        public PlanetViewHolder( TextView textView, CheckBox checkBox ) {
            this.checkBox = checkBox ;
            this.textView = textView ;
        }
        public CheckBox getCheckBox() {
            return checkBox;
        }
        public void setCheckBox(CheckBox checkBox) {
            this.checkBox = checkBox;
        }
        public TextView getTextView() {
            return textView;
        }
        public void setTextView(TextView textView) {
            this.textView = textView;
        }
    }

    /** Custom adapter for displaying an array of Planet objects. */
    private class PlanetArrayAdapter extends ArrayAdapter<Planet> {

        private LayoutInflater inflater;

        public PlanetArrayAdapter(Context context, List<Planet> planetList ) {
            super( context, R.layout.simplerow, R.id.rowTextView, planetList );
            // Cache the LayoutInflate to avoid asking for a new one each time.
            inflater = LayoutInflater.from(context) ;
        }

        @Override
        public View getView(int position, View convertView, ViewGroup parent) {
            // Planet to display
            Planet planet = this.getItem( position );

            // The child views in each row.
            CheckBox checkBox ;
            TextView textView ;

            // Create a new row view
            if ( convertView == null ) {
                convertView = inflater.inflate(R.layout.simplerow, null);

                // Find the child views.
                textView = (TextView) convertView.findViewById( R.id.rowTextView );
                checkBox = (CheckBox) convertView.findViewById( R.id.CheckBox01 );

                // Optimization: Tag the row with it's child views, so we don't have to
                // call findViewById() later when we reuse the row.
               // convertView.setTag( new PlanetViewHolder(textView,checkBox) );

                // If CheckBox is toggled, update the planet it is tagged with.
                checkBox.setOnClickListener( new View.OnClickListener() {
                    public void onClick(View v) {
                        CheckBox cb = (CheckBox) v ;
                        Planet planet = (Planet) cb.getTag();
                        planet.setChecked( cb.isChecked() );
                        Log.d("AAA", planet.getId());





                        int controlo=0;

                        for(int i=0; i<where.size();i++){

                            if(where.get(i).equals(planet.getId())){
                                where.remove(i);
                                controlo=1;
                            }

                        }

                        if(controlo==0){
                            where.add(planet.getId());

                        }

                        for(int i=0; i<where.size();i++){

                            Toast.makeText(MainActivity.this, where.get(i), Toast.LENGTH_SHORT).show();

                        }
                    }


                });


            }
            // Reuse existing row view
            else {
                // Because we use a ViewHolder, we avoid having to call findViewById().
                PlanetViewHolder viewHolder = (PlanetViewHolder) convertView.getTag();
                checkBox = viewHolder.getCheckBox() ;
                textView = viewHolder.getTextView() ;
            }

            // Tag the CheckBox with the Planet it is displaying, so that we can
            // access the planet in onClick() when the CheckBox is toggled.
            checkBox.setTag( planet );

            // Display planet data
            checkBox.setChecked( planet.isChecked() );
            textView.setText( planet.getName() );

            return convertView;
        }

    }

    public Object onRetainCustomNonConfigurationInstance () {
        return planets ;
    }

    public void aw(View view) {

        for(int i=0; i<where.size();i++){

            Toast.makeText(MainActivity.this, where.get(i), Toast.LENGTH_SHORT).show();

        }


        //cursor.requery();

    }


}
